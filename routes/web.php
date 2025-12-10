<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

//Cuentas Por Cobrar
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\OldPaymentController;


Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas PÚBLICAS (sin autenticación)
Route::get('/shop', [ProductController::class, 'shop'])->name('shop.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::resource('/products', ProductController::class); // publico
Route::get('/product/{id}/{slug}', [ProductController::class, 'details'])->name('product.details'); // Cambiado de /{id}/{slug}

// Rutas de autenticación
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

    // Rutas para reset de contraseña
Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');


    Route::middleware('auth')->group(function () {
    // Rutas de ADMIN
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::resource('/products', ProductController::class); // Ahora es /admin/products
        
        /* cambiar imagen principal (opcional) */
       
        Route::resource('/categories', CategoryController::class);
        Route::resource('/cities', CityController::class);

        Route::get('/cities/{id}/details', [CityController::class, 'getCityDetails'])->name('cities.details');


        // Rutas para administradores
        Route::resource('orders', OrderController::class)->except(['create', 'store']);
        Route::get('/orders/{order}/details', [OrderController::class, 'orderdetails'])->name('orders.orderdetails');
        Route::patch('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
      

        Route::resource('users', UserController::class);
      
    });

   

    // Ruta para logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Carrito y Wishlist
    Route::post('/sync/cart-wishlist', [CartController::class, 'syncCartWishlist'])->name('sync.cart.wishlist'); // Coma agregada
    Route::delete('/cart/{product_id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/wishlist/{product_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Checkout y pagos
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/shipping-address', [ShippingAddressController::class, 'store'])->name('shipping.store');
    Route::post('/checkout/stripe', [PaymentController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/checkout/success', [PaymentController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [PaymentController::class, 'cancel'])->name('checkout.cancel');

    // Dashboard usuario
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Direcciones de envío
    Route::post('/dashboard/address', [ShippingAddressController::class, 'storeAddress'])->name('address.store');
    Route::put('/dashboard/address/{id}', [ShippingAddressController::class, 'updateAddress'])->name('address.update');
    Route::delete('/dashboard/address/{id}', [ShippingAddressController::class, 'destroyAddress'])->name('address.destroy');

    // Actualizar perfil
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Rutas para administradores
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my-orders');

    //Rutas para el modulo Cuentas x Cobrar 
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Rutas para Cuentas por Cobrar
        Route::get('/receivables', [ReceivableController::class, 'index'])->name('receivables.index');
        Route::get('/receivables/create', [ReceivableController::class, 'create'])->name('receivables.create');
        Route::post('/receivables', [ReceivableController::class, 'store'])->name('receivables.store');
        Route::get('/receivables/{receivable}', [ReceivableController::class, 'show'])->name('receivables.show');
        Route::get('/receivables/{receivable}/edit', [ReceivableController::class, 'edit'])->name('receivables.edit');
        Route::put('/receivables/{receivable}', [ReceivableController::class, 'update'])->name('receivables.update');
        Route::delete('/receivables/{receivable}', [ReceivableController::class, 'destroy'])->name('receivables.destroy');
        
        // Rutas para Pagos
        Route::get('/receivables/{receivable}/payment', [ReceivableController::class, 'createPayment'])->name('receivables.payment.create');
        Route::post('/receivables/{receivable}/payments', [OldPaymentController::class, 'store'])->name('receivables.payments.store');
        Route::get('/payments/{payment}/receipt', [OldPaymentController::class, 'showReceipt'])->name('payments.receipt');
        Route::get('/payments/{payment}/receiptweb', [OldPaymentController::class, 'showReceipt'])->name('payments.receiptweb');
        Route::delete('/payments/{payment}', [OldPaymentController::class, 'destroy'])->name('payments.destroy');
    });

   

});



/* require __DIR__.'/auth.php'; */