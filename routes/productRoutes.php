<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::middleware('permission:create-product')->post("/", [ProductController::class, 'createProduct']);

Route::middleware('permission:readAll-product')->get("/", [ProductController::class, 'getAllProduct']);

Route::middleware('permission:readSingle-product')->get("/{id}", [ProductController::class, 'getSingleProduct']);

Route::middleware('permission:update-product')->put("/{id}", [ProductController::class, 'updateProduct']);

Route::middleware('permission:delete-product')->delete("/{id}", [ProductController::class, 'deleteProduct']);


