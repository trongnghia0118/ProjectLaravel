<?php
use App\Http\Controllers\Auth\ForgotPasswordController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;

use App\Http\Middleware\AdminMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'postregister']);
Route::post('/login', [UserController::class, 'postlogin']);
Route::get('/logout', function(){
  Auth::logout();
  return redirect()->route('register');
})->name('logout');
Route::get('/detail/{slug}', [ProductController::class, 'detail'])->name('detail');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart', [CartController::class, 'checkout']);
Route::prefix('api')->group(function(){
  Route::get('/comments/product/{product_id}',[CommentController::class,'product']);
  Route::get('/products/test',[ProductController::class,'home']);
  Route::post('/products', [ProductController::class, 'store']);
  Route::get('/products/{id}', [ProductController::class, 'show']);
  Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
  Route::resource('/comments',CommentController::class);
  Route::resource('/cart',CartController::class);

});
Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function (){
   Route::get('/',[AdminController::class,'dashboard'])->name('dashboard');
   Route::get('/product',[AdminController::class, 'product'])->name('product');
   Route::prefix('product')->name('product.')->group(function(){
    Route::get('/add', [AdminController::class, 'productAdd'])->name('add');
    Route::post('/add', [AdminController::class, 'postproductAdd']);
    Route::post('/delete/{id}',[AdminController::class, 'deleteproduct'])->name('delete');
    Route::get('/update/{id}', [AdminController::class, 'updateproduct'])->name('update');
    Route::post('/update/{id}', [AdminController::class, 'postupdateproduct']);
  });
  Route::get('/order',[AdminController::class, 'order'])->name('order');
  Route::prefix('/order')->name('order.')->group(function(){
    Route::get('/views/{id}',[AdminController::class, 'vieworder'])->name('views');
    Route::get('/update/{id}',[AdminController::class, 'updateorder'])->name('update');
    Route::post('/update/{id}',[AdminController::class, 'postupdateorder']);
  });
});
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password.form');
  Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('forgot-password.sendOtp');
  Route::get('verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('verify-otp.form');
  Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verify-otp.verify');
  Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset-password.form');
  Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password.reset');
  Route::get('/theodoidon/{id}', [OrderController::class, 'follow'])->name('viewsorder');