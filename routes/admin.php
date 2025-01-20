<?php

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.home');

Route::group(['prefix' => 'products'], function () {
    Route::get('/list', [AdminProductController::class, 'list'])->name('admin.products.list');
    Route::get('/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/store', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/detail/{id}', [AdminProductController::class, 'detail'])->name('admin.products.detail');
    Route::put('/update/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/delete/{id}', [AdminProductController::class, 'delete'])->name('admin.products.delete');
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/show', [AdminHomeController::class, 'showProfile'])->name('admin.profile.show');
    Route::post('/update', [AdminHomeController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/change-password', [AdminHomeController::class, 'changePassword'])->name('admin.profile.change.password');
});
