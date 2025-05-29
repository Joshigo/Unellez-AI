<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Training\TrainingController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', [AuthController::class, 'index'])->name('indexLogin');

// Route::post('/login', function () {
//     return view('auth.login');
// })->name('logins');

Route::get('/login', function () {
    return view('auth.login');
})->name('logins');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgotPassword', function () {
    return view('auth.forgotPassword');
})->name('password.forgot');

Route::post('/verify', [AuthController::class, 'verify'])->name('user.verify');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->middleware(['auth', 'role:1,2']);
    Route::resource('trainings', TrainingController::class)->middleware(['auth', 'role:1,2,3']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/success', [AuthController::class, 'success'])->name('success');
    Route::post('/send-code', [AuthController::class, 'resendVerificationCode'])->name('resend.code');
    Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('user.verify.page');
    Route::resource('dashboard', DashboardController::class);
});

Route::get('/auth-verifyEmail', function () {
    return view('auth.verifyEmail');
})->name('auth.verifyEmail');
