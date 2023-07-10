<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('operator')->middleware(['auth','auth.operator'])->group(function() {
    // router for user with role 'OPERATOR'
    Route::get('home', [OperatorController::class, 'index'])->name('operator.home');
    Route::resource('user', UserController::class);
});

Route::prefix('wali')->middleware(['auth','auth.wali'])->group(function() {
    // router for user with role 'WALI'
    Route::get('home', [WaliController::class, 'index'])->name('wali.home');
});

Route::prefix('admin')->middleware(['auth','auth.admin'])->group(function() {
    // router for user with role 'ADMIN'
    Route::get('home', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::get('logout', function() {
    Auth::logout();
    return redirect('login');
})->name('logout');
