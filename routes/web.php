<?php

use App\Http\Controllers\AuthController;
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

Route::get('/',  [AuthController::class, 'dashboard'])->name('app');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('app.dashboard');

Route::get('login', [AuthController::class, 'login'])->name('app.login');
Route::post('login/do', [AuthController::class, 'authenticate'])->name('app.login.authenticate');

Route::get('register', [AuthController::class, 'register'])->name('app.register');
Route::post('register/do', [AuthController::class, 'create'])->name('app.register.create');

Route::get('logout', [AuthController::class, 'logout'])->name('app.logout');

//socialite

Route::get('login/{provider}', [AuthController::class, 'redirectToProvider'])->name('app.social.login');
Route::get('login/{provider}/callback', [AuthController::class, 'handleProviderCallback'])->name('app.social.login.callback');

Route::get('password/reset', [AuthController::class, 'forgotPassword'])->name('app.forgotpassword');
Route::post('password/reset/do', [AuthController::class, 'forgotPasswordDo'])->name('app.forgotpassword.do');

Route::get('password/redefine/{token}',  [AuthController::class, 'redefinePassword'])->name('password.reset');
Route::post('password/redefine/do',  [AuthController::class, 'handleRedefinePassword'])->name('password.request');
