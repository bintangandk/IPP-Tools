<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use GuzzleHttp\Middleware;
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

Route::get('/', function () {
    return view('auth.login');
})->name('login.get');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/management-user', function () {
        return view('page.user-management.data-user');
    });

    Route::get('/create-user', function () {
        return view('page.user-management.create-user');
    });

    Route::get('/registered-partner', function () {
        return view('page.registered-partner.data-partner');
    });

    Route::get('/create-partner', function () {
        return view('page.registered-partner.create-partner');
    });

    Route::get('/deleted-partner', function () {
        return view('page.deleted-partner.data-deleted');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');
});
