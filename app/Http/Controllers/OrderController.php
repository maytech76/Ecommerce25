<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use App\Models\Table;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(){

        $orders = Order::with(['user', 'orderItems.product'])
                      ->latest()
                      ->paginate(10);
                      /* dd($orders->toArray()); */

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order){

        $order->load(['user', 'userAddress', 'orderItems.product']);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order){

        $order->load(['user', 'userAddress', 'orderItems.product']);

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order){

        $validated = $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order)
                         ->with('success', 'Orden actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order){

        $order->delete();

        return redirect()->route('orders.index')
                         ->with('success', 'Orden eliminada exitosamente.');
    }

    /**
     * Display user's orders
     */
    public function myOrders(){

        $orders = Order::with(['orderItems.product'])
                      ->where('user_id', Auth::id())
                      ->latest()
                      ->paginate(10);

        return view('orders.my-orders', compact('orders'));
    }

    /**
     * Update order status via AJAX
     */
    public function updateStatus(Request $request, Order $order){
        
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $order->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado exitosamente.',
            'status' => $order->status
        ]);
    }
    

    public function calculateShipping($shippingAddressId){

        $address = ShippingAddress::with(['zone.city'])->find($shippingAddressId);
        
        $shippingPrice = $address->shipping_price;
        $cityName = $address->city_name;
        $zoneName = $address->zone_name;
        
        return [
            'price' => $shippingPrice,
            'city' => $cityName,
            'zone' => $zoneName
        ];
    }


    public function createShippingAddress(Request $request){

        $request->validate([
            'address' => 'required|string',
            'zone_id' => 'required|exists:zones,id',
        ]);

        $address = ShippingAddress::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'zone_id' => $request->zone_id,
        ]);

        // Obtener información completa
        $shippingCost = $address->shipping_price;
        $fullLocation = $address->full_location;
        
        return response()->json([
            'address' => $address,
            'shipping_cost' => $shippingCost,
            'location' => $fullLocation
        ]);
    }

    /**
     * Display detailed order information for web view
     */
    public function orderDetails(Order $order){

        // Cargar relaciones disponibles
        $order->load([
            'user',
            'userAddress',
            'orderItems.product',
            'payment'
        ]);

        // Calcular estadísticas
        $statistics = [
            'total_products' => $order->orderItems->sum('quantity'),
            'unique_products' => $order->orderItems->count(),
            'subtotal' => $order->orderItems->sum('subtotal'),
            'total' => $order->total_price
        ];

        // Timeline de la orden
        $timeline = [];
        
        $timeline[] = [
            'date' => $order->created_at,
            'event' => 'Orden creada',
            'description' => 'La orden fue creada en el sistema',
            'icon' => 'bi-cart-plus'
        ];
        
        if ($order->payment) {
            $timeline[] = [
                'date' => $order->payment->created_at,
                'event' => 'Pago registrado',
                'description' => 'Se registró un pago para esta orden',
                'icon' => 'bi-credit-card'
            ];
        }
        
        $statusEvents = [
            'pending' => ['Orden pendiente', 'La orden está en espera de procesamiento'],
            'paid' => ['Orden pagada', 'La orden ha sido pagada'],
            'shipped' => ['Orden enviada', 'La orden ha sido despachada'],
            'cancelled' => ['Orden cancelada', 'La orden fue cancelada']
        ];
        
        if (isset($statusEvents[$order->status])) {
            $timeline[] = [
                'date' => $order->updated_at,
                'event' => $statusEvents[$order->status][0],
                'description' => $statusEvents[$order->status][1],
                'icon' => $order->status == 'pending' ? 'bi-clock' : 
                         ($order->status == 'paid' ? 'bi-check-circle' : 
                         ($order->status == 'shipped' ? 'bi-truck' : 'bi-x-circle'))
            ];
        }

        return view('orders.details', compact('order', 'statistics', 'timeline'));
    }

    /**
     * Generate order timeline
     */
    private function getOrderTimeline(Order $order){
        $timeline = [];
        
        $timeline[] = [
            'date' => $order->created_at,
            'event' => 'Orden creada',
            'description' => 'La orden fue creada en el sistema',
            'icon' => 'bi-cart-plus'
        ];
        
        if ($order->paid_at) {
            $timeline[] = [
                'date' => $order->paid_at,
                'event' => 'Pago confirmado',
                'description' => 'El pago fue procesado exitosamente',
                'icon' => 'bi-credit-card'
            ];
        }
        
        if ($order->shipped_at) {
            $timeline[] = [
                'date' => $order->shipped_at,
                'event' => 'Orden enviada',
                'description' => 'La orden ha sido despachada',
                'icon' => 'bi-truck'
            ];
        }
        
        if ($order->delivered_at) {
            $timeline[] = [
                'date' => $order->delivered_at,
                'event' => 'Orden entregada',
                'description' => 'La orden fue entregada al cliente',
                'icon' => 'bi-house-check'
            ];
        }
        
        usort($timeline, function($a, $b) {
            return $a['date'] <=> $b['date'];
        });
        
        return $timeline;
    }

    /**
     * Display order dispatch information
     */
    public function ordedispatched(Order $order){
        
        $order->load([
            'user',
            'userAddress.zone.city',
            'orderItems.product',
            'orderItems.product.images',
            'payment',
            'shippingAddress'
        ]);

        $totals = [
            'subtotal' => $order->orderItems->sum('subtotal'),
            'shipping' => $order->shipping_cost ?? 0,
            'tax' => $order->tax_amount ?? 0,
            'discount' => $order->discount_amount ?? 0,
            'total' => $order->total_price
        ];

        $dispatchInfo = [
            'dispatch_date' => now(),
            'dispatch_number' => 'DESP-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
            'prepared_by' => Auth::user()->name,
            'status' => $order->status
        ];

        return view('dispatched.ordedispatched', compact('order', 'totals', 'dispatchInfo'));
    }

    public function showTableSelection(){

        Log::info('=== INICIO showTableSelection ===');
        
        // Obtener items del carrito
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        
        Log::info('Items en carrito: ' . $cartItems->count());
        
        // Verificar si el carrito está vacío
        if($cartItems->isEmpty()) {
            Log::warning('Carrito vacío, redirigiendo a cart.index');
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }
        
        // Obtener SOLO las mesas disponibles
        $tables = Table::where('status', 'disponible')->get();
        
        Log::info('Mesas disponibles encontradas: ' . $tables->count());
        
        // Obtener mesa seleccionada previamente (de sesión)
        $selectedTableId = session('selected_table_id');
        $selectedTable = $selectedTableId ? Table::find($selectedTableId) : null;
        
        Log::info('Mesa seleccionada en sesión: ' . ($selectedTableId ?? 'ninguna'));
        
        return view('cart.checkout', [
            'cartItems' => $cartItems,
            'tables' => $tables,
            'selectedTable' => $selectedTable,
            'selectedTableId' => $selectedTableId,
        ]);
    }

    /**
     * Procesar la orden y guardar en la base de datos
     */
    public function storeOrder(Request $request){
        
        Log::info('=== INICIO storeOrder ===');
        Log::info('Datos recibidos:', $request->all());
        
        // Validar que se haya seleccionado una mesa
        try {
            $validated = $request->validate([
                'table_id' => 'required|exists:tables,id',
            ]);
            Log::info('Validación pasada correctamente. table_id: ' . $request->table_id);
        } catch (\Exception $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Debe seleccionar una mesa válida');
        }
        
        $user = auth()->user();
        Log::info('Usuario autenticado ID: ' . ($user->id ?? 'no autenticado'));
        
        if (!$user) {
            Log::error('Usuario no autenticado');
            return redirect()->route('login')->with('error', 'Debe iniciar sesión');
        }
        
        $tableId = $request->table_id;
        Log::info('Mesa seleccionada ID: ' . $tableId);
        
        // Verificar que la mesa esté disponible
        $table = Table::find($tableId);
        if (!$table) {
            Log::error('Mesa no encontrada ID: ' . $tableId);
            return redirect()->back()->with('error', 'La mesa seleccionada no existe');
        }
        
        Log::info('Mesa encontrada: ' . $table->name . ', Status actual: ' . $table->status);
        
        // Verificar que la mesa esté disponible
        if($table->status != 'disponible') {
            Log::warning('Mesa no disponible. Status actual: ' . $table->status);
            return redirect()->back()->with('error', 'La mesa seleccionada no está disponible');
        }
        
        // Obtener el carrito del usuario ANTES de la transacción
        $cart = Cart::where('user_id', $user->id)->with('product')->get();
        Log::info('Items en carrito ANTES de crear orden: ' . $cart->count());
        
        // Mostrar detalles del carrito
        foreach ($cart as $item) {
            Log::info('Carrito item - Producto ID: ' . $item->product_id . ', Cantidad: ' . $item->quantity . ', Precio: ' . $item->price);
        }
        
        if($cart->isEmpty()) {
            Log::warning('Carrito vacío para usuario ID: ' . $user->id);
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }
        
        // Calcular totales
        $subTotal = $cart->sum(fn($item) => $item->price * $item->quantity);
        $total = $subTotal;
        Log::info('Subtotal calculado: ' . $subTotal . ', Total: ' . $total);
        
        DB::beginTransaction();
        Log::info('Iniciando transacción DB');
        
        try {
            // 1. Crear la orden
            $orderData = [
                'user_id' => $user->id,
                'table_id' => $tableId,
                'total_price' => $total,
                'status' => 'pending',
            ];
            Log::info('Datos de orden a crear:', $orderData);
            
            $order = Order::create($orderData);
            Log::info('Orden creada con ID: ' . $order->id);
            
            // 2. Agregar productos a la orden
            foreach ($cart as $item) {
                $orderItemData = [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->price * $item->quantity,
                ];
                Log::info('Creando OrderItem:', $orderItemData);
                
                OrderItem::create($orderItemData);
                Log::info('OrderItem creado para producto ID: ' . $item->product_id);
            }
            
            // 3. ACTUALIZAR EL ESTADO DE LA MESA A "OCUPADA"
            $table->status = 'ocupada';
            $table->save();
            Log::info('✅ Estado de la mesa actualizado: ' . $table->name . ' -> ' . $table->status);
            
            // 4. VACIAR EL CARRITO - MÉTODO MEJORADO
            // Opción 1: Eliminar todos los items del carrito
            $deletedCount = Cart::where('user_id', $user->id)->delete();
            Log::info('🗑️ Carrito vaciado. Items eliminados: ' . $deletedCount);
            
            // Opción 2: Si la opción 1 no funciona, usar forceDelete
            if ($deletedCount == 0) {
                Log::warning('⚠️ No se eliminaron items con delete(), intentando forceDelete()');
                $deletedCount = Cart::where('user_id', $user->id)->forceDelete();
                Log::info('🗑️ Carrito vaciado con forceDelete. Items eliminados: ' . $deletedCount);
            }
            
            // Verificar que el carrito realmente esté vacío
            $cartAfterDelete = Cart::where('user_id', $user->id)->count();
            Log::info('Verificación post-eliminación - Items restantes en carrito: ' . $cartAfterDelete);
            
            if ($cartAfterDelete > 0) {
                Log::error('❌ Error: El carrito aún tiene ' . $cartAfterDelete . ' items después de intentar vaciarlo');
                // Intentar eliminar directamente con query brute
                DB::table('carts')->where('user_id', $user->id)->delete();
                Log::info('Se usó DB::table para eliminar items restantes');
            }
            
            DB::commit();
            Log::info('✅ Transacción completada exitosamente');
            
            // Limpiar sesión
            session()->forget('selected_table_id');
            
            // Limpiar carrito de la sesión si existe
            if (session()->has('cart')) {
                session()->forget('cart');
                Log::info('Carrito eliminado de la sesión');
            }
            
            Log::info('Redirigiendo a order.success con ID: ' . $order->id);
            
            return redirect()->route('order.success', $order->id)
                ->with('success', '¡Pedido realizado con éxito! Mesa ' . $table->name . ' asignada.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('❌ Error al crear la orden: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Error al procesar el pedido: ' . $e->getMessage());
        }
    }
    
    /**
     * Mostrar página de éxito después de la orden
     */
    public function orderSuccess($orderId){
        Log::info('=== INICIO orderSuccess ===');
        Log::info('Order ID: ' . $orderId);
        
        try {
            $order = Order::with('orderItems.product', 'table')->findOrFail($orderId);
            Log::info('Orden encontrada. Usuario ID: ' . $order->user_id . ', Autenticado ID: ' . auth()->id());
            
            // Verificar que la orden pertenezca al usuario autenticado
            if($order->user_id != auth()->id()) {
                Log::warning('Usuario no autorizado para ver la orden');
                abort(403);
            }
            
            Log::info('Mostrando vista de éxito');
            return view('order.success', compact('order'));
            
        } catch (\Exception $e) {
            Log::error('Error en orderSuccess: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'No se pudo encontrar la orden');
        }
    }

    /**
     * Liberar una mesa (cambiar estado a disponible)
     */
    public function liberarMesa($tableId){

        try {
            $table = Table::find($tableId);
            if ($table) {
                $table->status = 'disponible';
                $table->save();
                Log::info('Mesa liberada: ' . $table->name . ' -> disponible');
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Error al liberar mesa: ' . $e->getMessage());
            return false;
        }
    }




}