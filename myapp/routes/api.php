<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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
     Route::get('/home/search', [HomeController::class, 'search']);
     Route::get('/product/{id}', [ProductPageController::class, 'show']);
     Route::post('/cart/items', [CartController::class, 'addToCart']);
     Route::get('/cart', [CartController::class, 'getToCart']);
     Route::patch('/cart/items/{ItemId}', [CartController::class, 'changeQuantity']);
     Route::delete('/cart/items/{ItemId}', [CartController::class, 'deleteItem']);
     Route::post('/orders', [OrderController::class, 'store']);
   });
