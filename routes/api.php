<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Controllers\Api\ProductsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductsController::class, 'index']);
Route::post('/products/create', [ProductsController::class, 'create']);
Route::delete('/products/delete/{id}', [ProductsController::class, 'destroy']);

Route::get('/categories', [CategoriesController::class, 'index']);

Route::post('/uploadfile', [FileUploadController::class, 'upload']);
