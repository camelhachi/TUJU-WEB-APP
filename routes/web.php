<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('signup');
// });
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);
Route::get('/find-rooms', [HomeController::class, 'findRooms'])->name('findRooms');
Route::get('/options', [HomeController::class, 'options'])->name('options');



Route::get('/options', function () {
    return view('options');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/scart', function () {
    return view('scart');
});

use App\Http\Controllers\CartController;
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/store-room-details', [CartController::class, 'storeRoomDetails'])->name('storeRoomDetails');
Route::get('/scart',[CartController::class, 'cart'])->name('scart');
Route::post('/deleteCartItem', [CartController::class, 'deleteCartItem'])->name('deleteCartItem');
// web.php or routes/web.php



// routes/web.php

use App\Http\Controllers\PaymentController;
Route::post('/confirmPayment', [PaymentController::class, 'confirmPayment'])->name('confirmPayment');




Route::get('/form', function () {
    return view('form');
});

use App\Http\Controllers\BRController;
Route::match(['get','post'],'/processPayment', [BRController::class, 'processPayment'])->name('processPayment');




Route::get('/signup', function () {
    return view('signup');
});
// routes/web.php

use App\Http\Controllers\CustomerController;
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

use App\Http\Controllers\SignInController;

// Add these routes
Route::get('/signin', [SignInController::class, 'showForm'])->name('signin.form');
Route::post('/signin', [SignInController::class, 'signIn'])->name('signin');



Route::get('/bookingForm', [BookingController::class, 'showBookingForm'])->name('bookingForm');



Route::get('/signin', function () {
    return view('signin');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/midtrans', function () {
    return view('midtrans');
});




