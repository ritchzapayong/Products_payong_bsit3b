<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/productlist', [ProductController::class, 'prodmasterlist'])->name('products.masterlist');
Route::get('/array', [ProductController::class, 'productarray']);
Route::get('/with', [ProductController::class, 'prodWith']);
Route::get('/compact', [ProductController::class, 'prodcompact']);
Route::post('/add', [ProductController::class, 'addproduct'])->name('products.add');
Route::get('/edit/{index}', [ProductController::class, 'editproduct'])->name('products.edit');
Route::post('/update/{index}', [ProductController::class, 'updateproduct'])->name('products.update');
Route::get('/delete/{index}', [ProductController::class, 'deleteproduct'])->name('products.delete');
Route::get('/search', [ProductController::class, 'searchproduct'])->name('products.search');