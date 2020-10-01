<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'loginIndex'])->name('user.login');
Route::post('/', [UserController::class, 'login'])->name('user.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'users', 'as' => 'user.'], function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');

        Route::get('create', [AdminUserController::class, 'create'])->name('create');
        Route::post('store', [AdminUserController::class, 'store'])->name('store');

        Route::get('edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('update', [AdminUserController::class, 'update'])->name('update');

        Route::delete('destroy', [AdminUserController::class, 'destroy'])->name('destroy');

        Route::get('search', [AdminUserController::class, 'search'])->name('search');

        Route::get('logout', [UserController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
        Route::post('store', [OrderController::class, 'store'])->name('store');

        Route::put('update', [OrderController::class, 'updateState'])->name('update.state');

        Route::get('search', [OrderController::class, 'search'])->name('search');
    });
});
