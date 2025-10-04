<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/register', [RegistrationController::class, 'handlePost']);
Route::post('/register/check-code', [RegistrationController::class, 'checkCode']);
Route::post('/register/regenerateCode', [RegistrationController::class, 'regenerateCode']);
//Логин
Route::post('/login', [AuthController::class, 'login']);
//Роутеры которые требуют Jwt
Route::middleware('auth:api')->group(function(){
     Route::get('/home', [HomeController::class, 'getDataHomePage']);
     Route::get('/home/search/{word}', [HomeController::class, 'search']);
     Route::get('/product/{id}', [ProductPageController::class, 'show']);
     Route::post('/cart/items', [CartController::class, 'addToCart']);
     Route::get('/cart', [CartController::class, 'getToCart']);
     Route::patch('/cart/items/{ItemId}', [CartController::class, 'changeQuantity']);
     Route::delete('/cart/items/{itemId}', [CartController::class, 'deleteItem']);
     Route::post('/orders', [OrderController::class, 'store']);
     Route::get('/orders/order_items', [OrderController::class, 'getOrderItems']);


     Route::get('/profile', [ProfileController::class, 'getDataUser']);

     Route::post('/profile/data', [ProfileController::class, 'changeDataUser']);
     Route::patch('/profile/password', [ProfileController::class, 'changePasswordUser']);
     Route::post('/profile/email', [ProfileController::class, 'sendEmailVerificationCode']);
     Route::patch('/profile/email', [ProfileController::class, 'changeEmailUser']);

     Route::middleware('admin')->group(function(){
        Route::get('/admin', [AdminPanelController::class, 'getProductItems']);
        Route::post('/admin/product-store', [AdminPanelController::class, 'store']);
        Route::get('/admin/orders', [AdminPanelController::class, 'getOrders']);
        Route::patch('/admin/product/{ItemId}', [AdminPanelController::class, 'update']);
        Route::delete('/admin/product/{ItemId}', [AdminPanelController::class, 'delete']);
        Route::post('/admin/orders/{orderId}', [AdminPanelController::class, 'updateStatus']);
     });
   });
