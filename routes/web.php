<?php

use App\Models\User;
use App\Mail\Subscribed;
use App\Mail\Unsubscribed;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Laravel\Fortify\RoutePath;
use App\Models\EmailSubscriber;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\JsonResponse;
use App\Mail\AccountVerifiedSuccess;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;

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

    /* -------------------------------- Fortify Starts -------------------------------- */

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->name('dashboard');
    });

    Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
        $enableViews = config('fortify.views', true);

        // Authentication...
        if ($enableViews) {
            Route::get(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'create'])
                ->middleware(['guest:' . config('fortify.guard')])
                ->name('login');
        }

        $limiter = config('fortify.limiters.login');
        $twoFactorLimiter = config('fortify.limiters.two-factor');
        $verificationLimiter = config('fortify.limiters.verification', '6,1');

        Route::post(RoutePath::for('login', '/login'), [AuthenticatedSessionController::class, 'store'])
            ->middleware(array_filter([
                'guest:' . config('fortify.guard'),
                $limiter ? 'throttle:' . $limiter : null,
            ]));

        Route::post(RoutePath::for('logout', '/logout'), [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        // Password Reset...
        if (Features::enabled(Features::resetPasswords())) {
            if ($enableViews) {
                Route::get(RoutePath::for('password.request', '/forgot-password'), [PasswordResetLinkController::class, 'create'])
                    ->name('password.request');

                Route::get(RoutePath::for('password.reset', '/reset-password/{token}'), [NewPasswordController::class, 'create'])
                    ->middleware(['guest:' . config('fortify.guard')])
                    ->name('password.reset');
            }

            Route::post(RoutePath::for('password.email', '/forgot-password'), function (Request $request) {
                Validator::make($request->all(), [
                    'email' => 'required|email',
                    'g-recaptcha-response' => 'required|captcha',
                ], [
                    'g-recaptcha-response' => 'Please complete the reCAPTCHA verification.',
                ])->validate();

                $status = (Password::broker(config('fortify.passwords')))->sendResetLink(
                    $request->only(Fortify::email())
                );

                return $status == Password::RESET_LINK_SENT
                    ? app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $status])
                    : app(FailedPasswordResetLinkRequestResponse::class, ['status' => $status]);
            })
                ->middleware(['guest:' . config('fortify.guard')])
                ->name('password.email');

            Route::post(RoutePath::for('password.update', '/reset-password'), [NewPasswordController::class, 'store'])
                ->middleware(['guest:' . config('fortify.guard')])
                ->name('password.update');
        }

        // Registration...
        if (Features::enabled(Features::registration())) {
            if ($enableViews) {
                Route::get(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'create'])
                    ->middleware(['guest:' . config('fortify.guard')])
                    ->name('register');
            }

            Route::post(RoutePath::for('register', '/register'), [RegisteredUserController::class, 'store'])
                ->middleware(['guest:' . config('fortify.guard')]);
        }

        // Email Verification...
        if (Features::enabled(Features::emailVerification())) {
            if ($enableViews) {
                Route::get(RoutePath::for('verification.notice', '/email/verify'), [EmailVerificationPromptController::class, '__invoke'])
                    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                    ->name('verification.notice');
            }

            Route::get(RoutePath::for('verification.verify', '/email/verify/{id}/{hash}'), function (Request $request) {
                if ($request->user()->hasVerifiedEmail()) {
                    return redirect()->route('verified');
                }

                if ($request->user()->markEmailAsVerified()) {
                    event(new Verified($request->user()));
                    Mail::to($request->user())->send(new AccountVerifiedSuccess($request->user()));
                }

                return redirect()->route('verified');
            })
                ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'throttle:' . $verificationLimiter])
                ->name('verification.verify');

            Route::post(RoutePath::for('verification.send', '/email/verification-notification'), function (Request $request) {
                Validator::make(
                    $request->all(),
                    [
                        'g-recaptcha-response' => 'required|captcha'
                    ],
                    [
                        'g-recaptcha-response' => 'Please complete the reCAPTCHA verification.',
                    ]
                )->validate();

                if ($request->user()->hasVerifiedEmail()) {
                    return $request->wantsJson()
                        ? new JsonResponse('', 204)
                        : redirect()->intended(Fortify::redirects('email-verification'));
                }

                $request->user()->sendEmailVerificationNotification();

                return $request->wantsJson()
                    ? new JsonResponse('', 202)
                    : back()->with('status', Fortify::VERIFICATION_LINK_SENT);
            })
                ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'throttle:' . $verificationLimiter])
                ->name('verification.send');
        }

        // Profile Information...
        if (Features::enabled(Features::updateProfileInformation())) {
            Route::put(RoutePath::for('user-profile-information.update', '/user/profile-information'), [ProfileInformationController::class, 'update'])
                ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                ->name('user-profile-information.update');
        }

        // Passwords...
        if (Features::enabled(Features::updatePasswords())) {
            Route::put(RoutePath::for('user-password.update', '/user/password'), [PasswordController::class, 'update'])
                ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                ->name('user-password.update');
        }

        // Password Confirmation...
        if ($enableViews) {
            Route::get(RoutePath::for('password.confirm', '/user/confirm-password'), [ConfirmablePasswordController::class, 'show'])
                ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')]);
        }

        Route::get(RoutePath::for('password.confirmation', '/user/confirmed-password-status'), [ConfirmedPasswordStatusController::class, 'show'])
            ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            ->name('password.confirmation');

        Route::post(RoutePath::for('password.confirm', '/user/confirm-password'), [ConfirmablePasswordController::class, 'store'])
            ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            ->name('password.confirm');

        // Two Factor Authentication...
        if (Features::enabled(Features::twoFactorAuthentication())) {
            if ($enableViews) {
                Route::get(RoutePath::for('two-factor.login', '/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'create'])
                    ->middleware(['guest:' . config('fortify.guard')])
                    ->name('two-factor.login');
            }

            Route::post(RoutePath::for('two-factor.login', '/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'store'])
                ->middleware(array_filter([
                    'guest:' . config('fortify.guard'),
                    $twoFactorLimiter ? 'throttle:' . $twoFactorLimiter : null,
                ]));

            $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
                ? [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'password.confirm']
                : [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')];

            Route::post(RoutePath::for('two-factor.enable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'store'])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.enable');

            Route::post(RoutePath::for('two-factor.confirm', '/user/confirmed-two-factor-authentication'), [ConfirmedTwoFactorAuthenticationController::class, 'store'])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.confirm');

            Route::delete(RoutePath::for('two-factor.disable', '/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'destroy'])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.disable');

            Route::get(RoutePath::for('two-factor.qr-code', '/user/two-factor-qr-code'), [TwoFactorQrCodeController::class, 'show'])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.qr-code');

            Route::get(RoutePath::for('two-factor.secret-key', '/user/two-factor-secret-key'), [TwoFactorSecretKeyController::class, 'show'])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.secret-key');

            Route::get(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'index'])
                ->middleware($twoFactorMiddleware)
                ->name('two-factor.recovery-codes');

            Route::post(RoutePath::for('two-factor.recovery-codes', '/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'store'])
                ->middleware($twoFactorMiddleware);
        }
    });

    /* ------------------------------ Fortify Ends ------------------------------ */

    // Homepage.
    Route::get('/', function () {
        $testimonials = Testimonial::get();
        return view('welcome', compact('testimonials'));
    })->middleware('guest')->name('homePage');

    /* ----------------------------  Social SignIn/SignUp. --------------------------- */

    Route::get('/social-auth', function () {
        return view('auth.social-auth');
    })->name('socialAuth');

    // Google.

    Route::get('/auth/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('google');

    Route::get('/auth/google-callback', function (Request $request) {
        $response = Socialite::driver('google')->user();

        $user = User::where('email', $response->user['email'])->first();

        if ($user) {
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('filament.user.pages.dashboard');
        } else {
            $newUser = new User();
            $newUser->name = $response->user['name'];
            $newUser->email = $response->user['email'];
            $newUser->password = bcrypt(Str::random(16));
            $newUser->email_verified_at = now();
            $newUser->save();

            Auth::login($newUser);

            $request->session()->regenerate();

            return redirect()->route('filament.user.pages.dashboard');
        }
    })->name('googleCallback');

    // Facebook.

    Route::get('/auth/facebook', function () {
        return Socialite::driver('facebook')->redirect();
    })->name('facebook');

    Route::get('/auth/facebook-callback', function (Request $request) {
        $response_user = Socialite::driver('facebook')->user();
        $user = User::where('email', $response_user->email)->first();

        if ($user) {
            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('filament.user.pages.dashboard');
        } else {
            $newUser = new User();
            $newUser->name = $response_user->name;
            $newUser->email = $response_user->email;
            $newUser->password = bcrypt(Str::random(16));
            $newUser->email_verified_at = now();
            $newUser->save();

            Auth::login($newUser);

            $request->session()->regenerate();

            return redirect()->route('filament.user.pages.dashboard');
        }
    })->name('facebookCallback');


    /* ------------------------ Account verified notice. ------------------------ */

    Route::view('/verified', 'profile.response')->name('verified');

    /* ------------------------------- Legal Links. ------------------------------ */

    Route::get('terms-and-conditions', [TermsOfServiceController::class, 'show'])->name('terms.show');

    Route::get('privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');

    Route::get('dmca', function () {
        $dmcaFile = Jetstream::localizedMarkdownPath('dmca.md');

        return view('dmca', [
            'dmca' => Str::markdown(file_get_contents($dmcaFile)),
        ]);
    })->name('dmca.show');

    Route::get('gdpr', function () {
        $gdprFile = Jetstream::localizedMarkdownPath('gdpr.md');

        return view('gdpr', [
            'gdpr' => Str::markdown(file_get_contents($gdprFile)),
        ]);
    })->name('gdpr.show');

    /* ---------------------------------- Blogs ---------------------------------- */

    Route::get('blogs', function () {
        return view('blogs.listings');
    });

    Route::get('blogs/{post_id}/{post_title}', function () {
        return view('blogs.show');
    });

    /* ---------------------------------- Event --------------------------------- */

    // Preview
    Route::get('event/preview/{hash_id}', function () {
        return 'Test';
    })->name('event.preview');

    /* ---------------------------------- Unsubscribe --------------------------------- */

    Route::get('unsubscribe/{token}', function ($token) {
        $subscriber = EmailSubscriber::where('token', $token)->where('subscribed', 1)->first();

        if (empty($subscriber)) {
            Notification::make()
                ->title('Unable to unsubscribe from ' . env('APP_NAME'))
                ->body('Possible reason: The email is not subscribed.')
                ->danger()
                ->send();
        } else {
            EmailSubscriber::where('email', $subscriber->email)->update([
                'subscribed' => 0
            ]);

            Notification::make()
                ->title('You have successfully unsubscribed from ' . env('APP_NAME'))
                ->success()
                ->send();

            // Send notification email for unsubscribe success.
            Mail::to($subscriber->email)->send(new Unsubscribed($subscriber->token));
        }

        return redirect()->route('homePage');
    })->name('unsubscribe');

    /* ---------------------------------- Subscribe --------------------------------- */

    Route::get('subscribe/{token}', function ($token) {
        $subscriber = EmailSubscriber::where('token', $token)->where('subscribed', 0)->first();

        if (empty($subscriber)) {
            Notification::make()
                ->title('Unable to subscribe to ' . env('APP_NAME'))
                ->body('Possible reason: The email address is already subscribed.')
                ->danger()
                ->send();
        } else {
            EmailSubscriber::where('email', $subscriber->email)->update([
                'subscribed' => 1
            ]);

            Notification::make()
                ->title('You have successfully subscribed to ' . env('APP_NAME'))
                ->success()
                ->send();

            // Send notification email for subscription success.
            Mail::to($subscriber->email)->send(new Subscribed($subscriber->token));
        }

        return redirect()->route('homePage');
    })->name('subscribe');
});
