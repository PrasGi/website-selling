<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::middleware('auth')->group(function () {
    route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/followup', [DashboardController::class, 'followupIndexSales'])->name('followupIndexSales');
    Route::get('/followup-detail/{followup}', [FollowupController::class, 'detailForm'])->name('detailFollowup');
    Route::post('/followup-update{followup}', [FollowupController::class, 'save'])->name('saveFollowup');

    Route::middleware('role:2')->group(function () {
        Route::post('/add-followup', [FollowupController::class, 'store'])->name('addFollowup');
        Route::post('/followup/{followup}', [FollowupController::class, 'followUp'])->name('followUp');

        Route::post('/update-me/{user}', [UserController::class, 'updateMe'])->name('updateMe');
    });

    Route::prefix('/admin')->group(function () {
        Route::middleware('role:1')->group(function () {
            Route::get('/admin-control', [DashboardController::class, 'adminIndexAdmin'])->name('adminIndexAdmin');
            Route::get('/followup', [DashboardController::class, 'followupIndexAdmin'])->name('followupIndexAdmin');
            Route::get('/sales', [DashboardController::class, 'salesIndexAdmin'])->name('salesIndexAdmin');

            Route::post('/delete-followup/{followup}', [FollowupController::class, 'deleteFollow'])->name('deleteFollow');

            Route::post('/add-admin', [UserController::class, 'addAdmin'])->name('addAdmin');
            Route::delete('/delete-admin/{user}', [UserController::class, 'deleteAdmin'])->name('deleteAdmin');
            Route::post('/update-admin/{user}', [UserController::class, 'updateAdmin'])->name('updateAdmin');

            Route::post('/add-sales', [UserController::class, 'addSales'])->name('addSales');
            Route::post('/change-status-sales/{user}', [UserController::class, 'changeStatusSales'])->name('changeStatusSales');
            Route::get('/sales-detail/{user}', [DashboardController::class, 'salesDetailAdmin'])->name('salesDetailAdmin');
            Route::post('/update-sales/{user}', [UserController::class, 'updateSales'])->name('updateSales');

            Route::delete('/history-followup/{history}', [FollowupController::class, 'deleteHistoryFollowUp'])->name('deleteHistoryFollowUp');

            Route::get('/export-history/{user}', [FollowupController::class, 'export'])->name('export');
        });
    });
});
