<?php

use App\Courses\Helpers\ContentMigratorHelper;
use App\Courses\Models\Course;
use App\Courses\Models\CourseItems;
use App\Courses\Models\TypeOfItems;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\SocialController;
use App\Users\Controllers\LoginController;
use App\Users\Controllers\UserController;
use App\Users\Controllers\UserEmailConfirmationController;
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
Route::get('/users/{id}/request-email-confirmation', [UserEmailConfirmationController::class, 'requestEmailConfirmation'])->middleware('auth')->where('id', '[0-9]+')->name('users.request.email.confirmation');
Route::post('/users/{id}/send-email-confirmation', [UserEmailConfirmationController::class, 'sendEmailConfirmation'])->middleware('auth')->where('id', '[0-9]+')->name('users.send.email.confirmation');
Route::get('/users/{id}/email-confirmed/{token}', [UserEmailConfirmationController::class, 'emailConfirmed'])->where('id', '[0-9]+')->name('users.email.confirmed');

Route::get('/', [LoginController::class, 'login'])->name('main')->middleware('guest');
Route::get('/', [UserController::class, 'index'])->name('main')->middleware(['auth.admin', 'confirmed']);

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/vk/auth', [SocialController::class, 'index'])->name('vk.auth');
    Route::get('/vk/auth/callback', [SocialController::class, 'callBack']);
});

Route::get('/change-lang', [LocalizationController::class, 'changeLanguage'])->name('change.language');
