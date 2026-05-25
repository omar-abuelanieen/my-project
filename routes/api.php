<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');







Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/trashed', [ProductController::class, 'trashed']);

Route::post('/products', [ProductController::class, 'store']);

Route::get('/products/{product}', [ProductController::class, 'show']);

Route::put('/products/{product}', [ProductController::class, 'update']);

Route::delete('/products/{product}', [ProductController::class, 'destroy']);

Route::put( '/products/{product}/restore',  [ProductController::class, 'restore'])->withTrashed();

Route::delete('/products/{product}/force-delete',[ProductController::class, 'forceDelete'])->withTrashed();

Route::get('/ExpensiveProduct',[ProductController::class,'ExpensiveProduct']);

Route::get('/CheapProduct',[ProductController::class,'CheapProduct']);



Route::get('/orders/trashed', [OrderController::class, 'trashed']);

Route::put('/orders/{id}/restore', [OrderController::class, 'restore']);

Route::delete('/orders/{id}/force-delete', [OrderController::class, 'forceDelete']);

Route::get('/orders', [OrderController::class, 'index']);

Route::post('/orders', [OrderController::class, 'store']);

Route::get('/orders/{order}', [OrderController::class, 'show']);

Route::put('/orders/{order}', [OrderController::class, 'update']);

Route::delete('/orders/{order}', [OrderController::class, 'destroy']);


Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'store']);
Route::get('/users/{user}', [UsersController::class, 'show']);
Route::put('/users/{user}', [UsersController::class, 'update']);
Route::delete('/users/{user}', [UsersController::class, 'destroy']);


