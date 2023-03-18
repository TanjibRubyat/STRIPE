<?php

use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('connect',[StripeController::class,'get_connects']);
Route::post('connect',[StripeController::class,'create_customer']);
Route::post('create-connect',[StripeController::class,'create_connect']);
Route::post('links',[StripeController::class,'create_links']);
Route::post('product',[StripeController::class,'create_product']);