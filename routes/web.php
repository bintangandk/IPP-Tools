<?php

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
});

Route::get('/dashboard', function () {
    return view('page.dashboard');
});

Route::get('/management-user', function () {
    return view('page.user-management.data-user');
});

Route::get('/create-user', function () {
    return view('page.user-management.create-user');
});

Route::get('/registered-partner', function () {
    return view('page.registered-partner.data-partner');
});

Route::get('/deleted-partner', function () {
    return view('page.deleted-partner.data-deleted');
});

