<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(){

        $orders = Order::with(['user', 'orderItems.product'])
                      ->latest()
                      ->paginate(10);

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
}
