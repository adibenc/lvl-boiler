<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BaseAccount;
use App\Http\Controllers\API\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([
	'auth:sanctum',
	// 'otp',
	'verified',
])->group(function(){
	Route::get('user/home', [ HomeController::class, "home" ])
		->name("api.user.home");
	Route::get('user/me', [ UserController::class, "show" ])->name("user.me")
		->withoutMiddleware(["otp", "verified"]);
});

Route::get('version', function(){
    // to do - from env
    return response()->json([
        "version" => "x"
    ]);
})->name('api.version');


Route::prefix('auth')
	->group(function(){
	Route::post('login', [ AuthController::class, "login" ])
		->name("api.auth.m-login");
	// [ APIRegisterController::class, "register" ]
	Route::post('register', [Controller::class, 'unim'])
		->name("api.auth.register")
		->middleware([
			// "throttle:register",
			// "throttle:rl5x1h",
		]);
		// [ APIForgotPasswordController::class, "sendResetLinkEmail" ]
		Route::post('forgot-password', [Controller::class, 'unim'])
			->name("api.auth.forgot-pass");
});

Route::prefix('sys')
	->middleware('cron')
	->group(function(){
});


Route::post('/email/verification-notification',[ AuthController::class, "resendVerifyEmail" ])
	->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('auth/dotp', [ AuthController::class, "getOtpOvr" ])
	->name("api.auth.m-otp");

Route::get('/mx/1', [ BaseAccount::class, 'mx']);