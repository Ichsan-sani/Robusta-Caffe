<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['IsGuest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware(["IsLogin"])->group(function () {

    Route::get('/', [ProductController::class, 'showProduct'])->name('showProduct');

    Route::middleware("IsAdmin")->group(function () {
        Route::prefix("products")->name("products.")->group(function () {
            Route::get('/products', [ProductController::class, 'index'])->name('index');
            Route::get('/create/product', [ProductController::class, 'create'])->name('create');
            Route::post('/store/product', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/product/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::patch('/update/product/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('/delete/product/{id}', [ProductController::class, 'destroy'])->name('delete');
        });
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('index');
            Route::get('/create/user', [UserController::class, 'create'])->name('create_user');
            Route::post('/store/user', [UserController::class, 'store'])->name('store_user');
            Route::get('/edit/user/{id}', [UserController::class, 'edit'])->name('edit_user');
            Route::patch('/update/user/{id}', [UserController::class, 'update'])->name('update_user');
            Route::delete('/delete/user/{id}', [UserController::class, 'destroy'])->name('delete_user');
        });
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/data', [OrderController::class, 'data'])->name('data');
            Route::get('/export-ecxel', [OrderController::class, 'exportExcel'])->name('export-excel');
        });
    });

    Route::middleware('IsKasir')->group(function () {
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/orders', [OrderController::class, 'index'])->name('index');
            Route::get('/create', [OrderController::class, 'create'])->name('create');
            Route::post('/store', [OrderController::class, 'store'])->name('store');
            Route::get('/print/{id}', [OrderController::class, 'show'])->name('print');
        });
    });

    Route::get('/downloadPDF/{id}', [OrderController::class, 'downloadPDF'])->name('orders.download');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::view('/errors/403', 'errors.403')->name('errors.403');
