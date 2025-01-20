<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QrCodeController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'products'], function () {
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
});

Route::fallback(function () {
    return view('errors.404');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/handle-login', [AuthController::class, 'handleLogin'])->name('auth.handleLogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => 'error'], function () {
    Route::get('/not-found', [ErrorController::class, 'notFound'])->name('error.not.found');
    Route::get('/forbidden', [ErrorController::class, 'forbidden'])->name('error.forbidden');
    Route::get('/unauthorized', [ErrorController::class, 'unauthorized'])->name('error.unauthorized');
});

Route::group(['prefix' => 'api/qr-code'], function () {
    Route::get('/products/{id}', [QrCodeController::class, 'generate'])->name('qr.code.api.show.products');
});

/* Web routes */
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    require_once __DIR__ . '/admin.php';
});
