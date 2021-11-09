<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\UsersController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('products', ProductsController::class)->only([
    'destroy',
    'store',
    'update'
])->middleware(['api', 'jwt.auth']);

Route::resource('users', UsersController::class)->only([
    'store',
    'update'
])->middleware(['api']);

Route::post('login', [LoginController::class, 'login'])->middleware(['api']);
Route::post('logout', [LoginController::class, 'logout'])->middleware(['api', 'jwt.auth']);
