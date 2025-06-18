<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CategoryController;

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

// Welcome page
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Stock In Routes
    Route::prefix('stock-in')->name('stock.in.')->group(function () {
        Route::get('/', [StockInController::class, 'index'])->name('index');
        Route::get('/create', [StockInController::class, 'create'])->name('create');
        Route::post('/', [StockInController::class, 'store'])->name('store');
        Route::get('/{stockIn}', [StockInController::class, 'show'])->name('show');
        Route::get('/{stockIn}/edit', [StockInController::class, 'edit'])->name('edit');
        Route::put('/{stockIn}', [StockInController::class, 'update'])->name('update');
        Route::delete('/{stockIn}', [StockInController::class, 'destroy'])->name('destroy');
    });

    // Stock Out Routes
    Route::prefix('stock-out')->name('stock.out.')->group(function () {
        Route::get('/', [StockOutController::class, 'index'])->name('index');
        Route::get('/create', [StockOutController::class, 'create'])->name('create');
        Route::post('/', [StockOutController::class, 'store'])->name('store');
        Route::get('/{stockOut}', [StockOutController::class, 'show'])->name('show');
        Route::get('/{stockOut}/edit', [StockOutController::class, 'edit'])->name('edit');
        Route::put('/{stockOut}', [StockOutController::class, 'update'])->name('update');
        Route::delete('/{stockOut}', [StockOutController::class, 'destroy'])->name('destroy');
    });

    // Report Routes
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/stock-in', [ReportsController::class, 'stockIn'])->name('stock.in');
        Route::get('/stock-out', [ReportsController::class, 'stockOut'])->name('stock.out');
    });

    // Category Routes
    Route::resource('categories', CategoryController::class);
});
