<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PromoApiController;
use App\Http\Controllers\Api\ProdApiController;

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

Route::get('/login', [LoginController::class, 'credencial']);
Route::get('/promocion', [PromoApiController::class, 'promo']);
Route::get('/producto', [ProdApiController::class, 'producto']);