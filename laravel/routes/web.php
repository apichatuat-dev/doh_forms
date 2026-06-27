<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/districts/{province}', [LocationController::class, 'districts']);
Route::get('/sub-districts/{district}', [LocationController::class, 'subDistricts']);
Route::post('/login/onelogin', [LoginController::class, 'oneLogin']);
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Auth::routes();

// Index route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/forms', [FormsController::class, 'index'])->name('forms.index');
Route::get('/forms/create', [FormsController::class, 'create'])->name('forms.create');
Route::post('/forms/store', [FormsController::class, 'store'])->name('forms.store');
Route::delete('/forms/{id}/delete', [FormsController::class, 'delete'])->name('forms.delete');
Route::get('/forms/{id}/edit', [FormsController::class, 'edit'])->name('forms.edit');
Route::put('/forms/{id}/update', [FormsController::class, 'update'])->name('forms.update');
// // Use the ProductController for handling product-related routes
Route::middleware(['auth'])->group(function () {

    // Route for creating a new product
    Route::get('create', [ProductController::class, 'create'])->name('product.create');

    // Route for creating a new product
    Route::post('store', [ProductController::class, 'store'])->name('product.store');

    // Route for displaying a specific product
    Route::get('read/{id}', [ProductController::class, 'read'])->name('product.read');

    // Route for updating an existing product
    Route::get('update/{id}/edit', [ProductController::class, 'edit'])->name('product.update');

    // Route for updating an existing product
    Route::put('update/{id}', [ProductController::class, 'update'])->name('product.update');

    // Route for deleting a product
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
