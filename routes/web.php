<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| GADO_IT15_ENROLLMENT_SYSTEM — Routes
| University of Mindanao (Tagum Campus)
|--------------------------------------------------------------------------
*/

// ─── Public / Auth ───────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register'])->name('register.submit');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ─── Protected Portal Routes ─────────────────────
Route::middleware('student')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Enrollment
    Route::get('/enrollment',       [EnrollmentController::class, 'index'])->name('enrollment.index');
    Route::post('/enrollment/enroll', [EnrollmentController::class, 'enroll'])->name('enrollment.enroll');
    Route::post('/enrollment/drop',   [EnrollmentController::class, 'drop'])->name('enrollment.drop');

    // Academic Portal
    Route::get('/portal/grades',     [PortalController::class, 'grades'])->name('portal.grades');
    Route::get('/portal/attendance', [PortalController::class, 'attendance'])->name('portal.attendance');

    // Messages
    Route::get('/messages',             [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send',       [MessageController::class, 'send'])->name('messages.send');
    Route::patch('/messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');

    // Payments
    Route::get('/payments',     [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/pay', [PaymentController::class, 'pay'])->name('payments.pay');

});
