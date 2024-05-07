<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\HomeController as AdminHomeCtrl;
use App\Http\Controllers\Admin\Datatables\UserController as DtUser;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\Select2\S2User;

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

/**
 * todo:
 * middlewares
 * - admin
 * - isactive
 * 
 */

Route::prefix('')->group(function(){
    // group
});

allRoutes();

Route::prefix('shared')
->middleware(['auth'])
->group(function(){
	datatableRoute("users", DtUser::class);

	Route::get("s2/user", [S2User::class, "getQLike"])->name("admin.user.s2");
});

Route::prefix('admin')
->middleware(['auth'])
->group(function(){
	Route::get('/', [AdminHomeCtrl::class, 'index'])->name('admin.home');
	Route::get('/profile', [AdminHomeCtrl::class, 'profile'])->name('admin.profile');
	Route::get('/dash-data', [AdminHomeCtrl::class, 'getDashData'])
		->name('admin.dash-data');
});

Auth::routes();

Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::get('/auth/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('auth.logout');
// Route::get('/auth/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('auth.logout');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
