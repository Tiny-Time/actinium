<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

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

/* --------------------------------- Routes with middleware. --------------------------------- */

Route::middleware('domain.redirect')->group(function () {

    /* ---------------------------- General variables from env. ---------------------------- */

    $prodDomain = env('PROD_DOMAIN');
    $mProdDomain = env('MPROD_DOMAIN');
    $uAppDomain = env('UAPP_DOMAIN');
    $uMAppDomain = env('UMAPP_DOMAIN');
    $aaDomain = env('AA_DOMAIN');
    $mAAppDomain = env('MAAPP_DOMAIN');

    /* ------------------------------- All routes. ------------------------------- */

    $routes = function(){
        // Fortify.
        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
        });

        // Homepage.
        Route::get('/', function () {
            return view('welcome');
        })->name('homePage');

        // Social Login.
        Route::get('/social-login', function () {
            return view('auth.social-login');
        })->name('social-login');

        // Social Signup.
        Route::get('/social-signup', function () {
            return view('auth.social-login'); // test case
        })->name('social-signup');

        // Google.

        Route::get('/auth/google', function(){
            return Socialite::driver('google')->redirect();
        })->name('google');

        Route::get('/auth/google/callback', function(){
            $user = Socialite::driver('google')->user();
            var_dump($user);
        })->name('google-callback');

        /* ---------------  Override Fortify forgot password backend. -------------- */

        Route::post('/forgot-password-p', function (Request $request) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'g-recaptcha-response' => 'required|captcha',
            ],[
                'g-recaptcha-response' => 'Please complete the reCAPTCHA verification.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        })->name('custom_password.email');
    };

    /* ----------------------- Generic user website routes. ---------------------- */

    // Generic user website (desktop version).
    Route::domain($prodDomain)->group(function () use ($routes) {
        $routes();
    });

    // Generic user website (mobile version).
    Route::domain($mProdDomain)->group(function () use ($routes) {
        $routes();
    });

    /* -------------------- Authenticated user website routes. ------------------- */

    // Authenticated user website (desktop version).
    Route::domain($uAppDomain)->group(function () use ($routes) {
        $routes();
    });

    // Authenticated user website (mobile version).
    Route::domain($uMAppDomain)->group(function () use ($routes) {
        $routes();
    });

    /* ------------------------ Admin user website routes. ----------------------- */

    // Website admin (desktop version).
    Route::domain($aaDomain)->group(function () use ($routes) {
        $routes();
    });

    // Website admin (mobile version).
    Route::domain($mAAppDomain)->group(function () use ($routes) {
        $routes();
    });
});
