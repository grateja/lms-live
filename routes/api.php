<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\SyncController;

use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('test', [TestController::class, 'test']);

// Route::post('sync/job-order/{shopId}', [SyncController::class, 'jobOrder']);

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('/register', [AccountsController::class, 'register']);

// /api/auth
Route::prefix('auth')->middleware('auth:sanctum')->controller(AuthController::class)->group(function() {
    // /api/auth/logout
    Route::post('logout', 'logout');

    // /api/auth/check
    Route::get('check', 'check');
});

// /api/qr-code
Route::controller(QrCodeController::class)->prefix('qr-code')->group(function() {
    Route::middleware('auth:sanctum')->group(function() {
        // /api/qr-code/init-link
        Route::get('init-link', 'initLink');
    });
});

// /api/sync
Route::controller(SyncController::class)->prefix('sync')->middleware(['auth:sanctum', 'abilities:sync-update-data'])->group(function() {

    // /api/sync/job-order/{shopId}
    Route::post('job-order/{shopId}', 'jobOrder');

    // /api/sync/payment/{shopId}
    Route::post('payment/{shopId}', 'payment');

    // /api/sync/bulk/{shopId}
    Route::post('bulk/{shopId}', 'bulk');

});

Route::controller(ShopsController::class)->prefix('shop')->group(function() {
    // /api/shop/link/{ownerId}
    Route::post('link/{ownerId}', 'link')->middleware(['auth:sanctum', 'abilities:register-shop']);
});
