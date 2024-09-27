<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementUserController;
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
    // todo: menu dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // todo: menu management user
    Route::get('/management-user', [ManagementUserController::class, 'index'])->name('management-user.index');
    Route::get('/create-user', [ManagementUserController::class, 'create'])->name('management-user.create');
    Route::post('/management-user/create-user', [ManagementUserController::class, 'createPost'])->name('management-user.createPost');
    Route::delete('/management-user/delete/{user_id}', [ManagementUserController::class, 'delete'])->name('management-user.delete');
    Route::get('/management-user/edit/{user_id}', [ManagementUserController::class, 'edit'])->name('management-user.edit');
    Route::put('/management-user/edit/{user_id}', [ManagementUserController::class, 'editPost'])->name('management-user.editPost');

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
