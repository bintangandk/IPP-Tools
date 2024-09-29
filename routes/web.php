<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeletedPartnerController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\RegisteredPartnerController;
use App\Models\DeletedPartner;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // todo: menu management user
    Route::get('/management-user', [ManagementUserController::class, 'index'])->name('management-user');
    Route::get('/create-user', [ManagementUserController::class, 'create'])->name('create-user');
    Route::post('/management-user/create-user', [ManagementUserController::class, 'createPost'])->name('management-user.createPost');
    Route::delete('/management-user/delete/{user_id}', [ManagementUserController::class, 'delete'])->name('management-user.delete');
    Route::get('/management-user/edit/{user_id}', [ManagementUserController::class, 'edit'])->name('management-user.edit');
    Route::put('/management-user/edit/{user_id}', [ManagementUserController::class, 'editPost'])->name('management-user.editPost');

    // todo: menu registered partner
    Route::get('/registered-partner', [RegisteredPartnerController::class, 'index'])->name('registered-partner');
    Route::get('/create-partner', [RegisteredPartnerController::class, 'create'])->name('create-partner');
    Route::post('/create-partner-post', [RegisteredPartnerController::class, 'createPost'])->name('registered-partner.createPost');
    Route::get('/edit-partner/{im3_outlet_id}', [RegisteredPartnerController::class, 'edit'])->name('registered-partner.edit');
    Route::post('/registered-partner/import-partner', [RegisteredPartnerController::class, 'import'])->name('registered-partner.import');
    Route::put('/edit-partner-post/{im3_outlet_id}', [RegisteredPartnerController::class, 'editPost'])->name('registered-partner.editPost');
    Route::delete('/delete-partner/{im3_outlet_id}', [RegisteredPartnerController::class, 'delete'])->name('registered-partner.delete');

    // todo: menu deleted partner
    Route::get('/deleted-partner', function () {
        $data = DeletedPartner::orderBy('created_at', 'desc')->paginate(20);
        return view('page.deleted-partner.data-deleted')->with([
            'title' => 'Data Deleted',
            'data' => $data
        ]);
    })->name('deleted-partner');
    Route::post('/deleted-partner/restore/{id}', [DeletedPartnerController::class, 'restore'])->name('deleted-partner.restore');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');
});
