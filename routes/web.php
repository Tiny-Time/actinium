<?php

use App\Models\User;
use App\Mail\Subscribed;
use App\Mail\Unsubscribed;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmailSubscriber;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\Route;
use Filament\Notifications\Notification;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\EventController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;

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

Route::middleware(['domain.redirect', 'analytics'])->group(function () {

    /* -------------------------------- Fortify Starts -------------------------------- */

    require_once __DIR__ . '/fortify.php';

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

    // Create Shareable Event
    Route::post('event/create-shareable-event', [EventController::class, 'store'])->name('event.create');

    // Preview & Share
    Route::get('event/{event_id}', [EventController::class, 'show'])->name('event.preview');

    // Embed
    Route::get('event/embed/{event_id}', [EventController::class, 'index'])->name('event.embed');

    /* ----------------------------- Advanced Event ----------------------------- */

    Route::get('advanced-event', function () {
        return view('advanced-event');
    })->name('advanced-event');

    /* ---------------------------------- Unsubscribe --------------------------------- */

    Route::get('unsubscribe/{token}', function ($token) {
        $subscriber = EmailSubscriber::where('token', $token)->where('subscribed', 1)->first();

        if (empty ($subscriber)) {
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

        if (empty ($subscriber)) {
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

    // Themes/Templates Subscription

    Route::post('subscribe', function (Request $request) {

        $request->validate([
            'email' => 'required|email:rfc,dns|max:255|not_regex:/\bmailinator\.com\b/i'
        ]);

        // Check if the email already exists with subscribed status
        $existingSubscriber = EmailSubscriber::where('email', $request->email)->where('subscribed', 1)->first();

        if ($existingSubscriber) {
            // Email already subscribed
            return response()->json(['error' => 'This email address is already subscribed.'], 422);
        } else {
            $token = Str::random(16);

            EmailSubscriber::updateOrCreate([
                'email' => $request->email,
                'subscribed' => 1,
                'token' => $token,
            ]);

            // Send notification email for subscription success.
            Mail::to($request->email)->send(new Subscribed($token));

            return response()->json(['message' => 'Subscription successful.']);
        }
    })->name('tsubscribe');

    // Redirect
    Route::get('/user/profile', function () {
        return redirect()->route('filament.user.pages.profile');
    });

    /* ---------------------------- Generate Sitemap ---------------------------- */
    Route::get('/generate-sitemap', function () {

        SitemapGenerator::create(env('APP_URL'))->writeToFile('sitemap.xml');

        return 'Sitemap generated successfully!';
    });

    /* --------------------------- Error Page Preview --------------------------- */

    Route::get('/errors/{code}', function ($code) {
        return view('errors.'.$code);
    });

    /* ------------------------- Fully customizable 404 ------------------------- */

    Route::get('404', function(){
        return view('errors.404');
    });

    Route::fallback(function () {
        return redirect('404');
    });
});
