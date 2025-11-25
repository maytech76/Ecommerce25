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
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas PÚBLICAS (sin autenticación)
Route::get('/shop', [ProductController::class, 'shop'])->name('shop.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::resource('/products', ProductController::class); // publico
Route::get('/product/{id}/{slug}', [ProductController::class, 'details'])->name('product.details'); // Cambiado de /{id}/{slug}


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
      

      
    });

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

});



/* require __DIR__.'/auth.php'; */