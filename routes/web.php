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

/* ---------------------------- General variables ---------------------------- */

// Get app domain from env
$domain = env('APP_DOMAIN');

/* ------------------------ Admin user website routes ----------------------- */

// Admin user website funtion
$adminUserRoutes = function () {
    Route::middleware('domain.redirect')->group(function () {
        // Define admin user route here.
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
        });
    });
};

// Website admin (desktop version)
Route::domain('admin.' . $domain)->group(function () use ($adminUserRoutes) {
    $adminUserRoutes();
});

// Website admin (mobile version)
Route::domain('m-admin.' . $domain)->group(function () use ($adminUserRoutes) {
    $adminUserRoutes();
});

/* ----------------------- Generic user website routes ---------------------- */

// Generic user website funtion
$genericUserRoutes = function () {
    // Define generic user routes here.
    Route::middleware('domain.redirect')->group(function () {
        // Homepage
        Route::get('/', function () {
            return view('welcome');
        })->name('homePage');

        // Social Login
        Route::get('/social-login', function () {
            return view('auth.social-login');
        })->name('social-login');

        // Social Signup
        Route::get('/social-signup', function () {
            return view('auth.social-login'); // test case
        })->name('social-signup');

        // Google

        Route::get('/auth/google', function(){
            return Socialite::driver('google')->redirect();
        })->name('google');

        Route::get('/auth/google/callback', function(){
            $user = Socialite::driver('google')->user();
            var_dump($user);
        })->name('google-callback');

        // Redirect routes
        Route::get('/dashboard', function () {
            return redirect()->route('dashboard');
        });
    });
};

// Generic user website (desktop version)
Route::domain($domain)->group(function () use ($genericUserRoutes) {
    $genericUserRoutes();
});

// Generic user website (mobile version)
Route::domain('m.' . $domain)->group(function () use ($genericUserRoutes) {
    $genericUserRoutes();
});

/* -------------------- Authenticated user website routes ------------------- */

// Auth user website funtion
$authUserRoutes = function () {
    // Define authenticated user route here.
    Route::middleware('domain.redirect')->group(function () {
        Route::middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified'
        ])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
        });

        // Redirect routes
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });
    });
};

// Authenticated user website (desktop version)
Route::domain('app.' . $domain)->group(function () use ($authUserRoutes) {
    $authUserRoutes();
});

// Authenticated user website (mobile version)
Route::domain('m-app.' . $domain)->group(function () use ($authUserRoutes) {
    $authUserRoutes();
});


/* ---------------  Override Fortify forgot password backend -------------- */

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
