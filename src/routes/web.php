<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    echo "Hello 123";
});

Route::get('products', [ProductController::class, 'list']);
Route::get('pdf', [ProductController::class, 'pdf']);
Route::get('api', [ProductController::class, 'api']);
Route::get('raw', [ProductController::class, 'raw']);
