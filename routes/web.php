<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\CustomerRegisterController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */
Route::get('/', function () {
    return view('landing.index');
});


Route::get('/index', [App\Http\Controllers\LandingController::class, 'index'])->name('landing.index');
Route::get('/shop', [App\Http\Controllers\LandingController::class, 'shop'])->name('shop.index');
Route::get('/profile', [App\Http\Controllers\LandingController::class, 'profile'])->name('profile.index');
Route::get('/shopdetail/{id}', [App\Http\Controllers\LandingController::class, 'shopdetail'])->name('shopdetail.index');
Route::get('/cart', [App\Http\Controllers\LandingController::class, 'cart'])->name('cart.index');
Route::post('/wishlist/add/{productId}', [App\Http\Controllers\LandingController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/cart/updateAll', [App\Http\Controllers\LandingController::class, 'updateCartQuantities'])->name('cart.updateAll');
Route::post('/profile/update-address', [App\Http\Controllers\LandingController::class, 'updateAddress'])->name('profile.updateAddress');
Route::post('/profile/update-address-profile', [App\Http\Controllers\LandingController::class, 'updateAddressProfile'])->name('profile.update');
Route::get('/checkout/{order_id}', [App\Http\Controllers\LandingController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout/process', [App\Http\Controllers\LandingController::class, 'checkoutProcess'])->name('checkout.process');
Route::post('/pay-now/{orderId}', [App\Http\Controllers\LandingController::class, 'payNow'])->name('pay.now');
Route::get('/yourorder', [App\Http\Controllers\LandingController::class, 'order'])->name('yourorder.index');
Route::delete('/yourorder/{order_id}', [App\Http\Controllers\LandingController::class, 'deleteOrder'])->name('yourorder.delete');
Route::get('/yourdeliverie', [App\Http\Controllers\LandingController::class, 'deliverie'])->name('yourdeliverie.index');
Route::patch('/deliveries/{delivery}/done', [App\Http\Controllers\LandingController::class, 'markAsDone'])->name('deliveries.markAsDone');





// Route::get('/checkout/{orderId}', [App\Http\Controllers\LandingController::class, 'checkout'])->name('checkout.index');








Route::middleware('auth:admin')->group(function () {
    Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
    Route::resource('productcategories', \App\Http\Controllers\ProductCategoriesController::class);
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::resource('customer', \App\Http\Controllers\CustomerController::class);
    Route::resource('discountcat', \App\Http\Controllers\DiscountCategoriesController::class);
    Route::resource('discount', \App\Http\Controllers\DiscountController::class);
    Route::resource('order', \App\Http\Controllers\OrderController::class);
    Route::resource('orderdetail', \App\Http\Controllers\OrderDetailController::class);
    Route::resource('deliverie', \App\Http\Controllers\DeliverieController::class);
    Route::resource('wishlist', \App\Http\Controllers\WishlistController::class);
    Route::resource('payment', \App\Http\Controllers\PaymentController::class);

    Route::get('/exportPDF', [App\Http\Controllers\PaymentController::class, 'exportPDF'])->name('export.index');

});




// Routes for Admin Login and Register
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
    Route::post('login', [LoginController::class, 'login'])->middleware('guest:admin');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('admin.register')->middleware('guest:admin');
    Route::post('register', [RegisterController::class, 'register'])->middleware('guest:admin');
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function() {
            return view('dashboard.home');
        })->name('admin.dashboard');
    });
});

// Routes for Customer Login and Register
Route::prefix('user')->group(function () {
    Route::get('login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login')->middleware('guest:customer');
    Route::post('login', [CustomerLoginController::class, 'login'])->middleware('guest:customer');
    Route::post('logout', [CustomerLoginController::class, 'logout'])->name('customer.logout')->middleware('auth:customer');
    Route::get('register', [CustomerRegisterController::class, 'showRegisterForm'])->name('customer.register')->middleware('guest:customer');
    Route::post('register', [CustomerRegisterController::class, 'register'])->middleware('guest:customer');
    Route::middleware('auth:customer')->group(function () {
        Route::get('dashboard', function() {
            return view('landing.index');
        })->name('customer.dashboard');
    });
});




Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::post('logout', function () {Auth::logout();return redirect('/');})->name('logout');
