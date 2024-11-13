<?php

use App\Models\Plan;
use App\Models\User;
use App\Mail\Subscribed;
use App\Mail\Unsubscribed;
use App\Models\Testimonial;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Livewire\EventSearch;
use App\Models\EmailSubscriber;
use Laravel\Jetstream\Jetstream;
use Laravel\Cashier\Subscription;
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

/* ----------------------------  Social SignIn/SignUp. --------------------------- */

Route::middleware(['guest'])->group(function () {
    Route::get('/social-auth', function () {
        return view('auth.social-auth');
    })->name('socialAuth');

    // Google.

    Route::get('/auth/google', function () {
        // Store the intended URL in the session
        session(['url.intended' => url()->previous()]);
        return Socialite::driver('google')->redirect();
    })->name('google');

    Route::get('/auth/google-callback', function (Request $request) {
        $response = Socialite::driver('google')->user();

        $user = User::where('email', $response->user['email'])->first();

        if ($user) {
            Auth::login($user);
        } else {
            $newUser = new User();
            $newUser->name = $response->user['name'];
            $newUser->email = $response->user['email'];
            $newUser->password = bcrypt(Str::random(16));
            $newUser->email_verified_at = now();
            $newUser->save();

            Auth::login($newUser);
        }

        $request->session()->regenerate();

        // Redirect to the intended URL
        return redirect(session('url.intended'));
    })->name('googleCallback');

    // Facebook.

    Route::get('/auth/facebook', function () {
        session(['url.intended' => url()->previous()]);
        return Socialite::driver('facebook')->redirect();
    })->name('facebook');

    Route::get('/auth/facebook-callback', function (Request $request) {
        $response_user = Socialite::driver('facebook')->user();
        $user = User::where('email', $response_user->email)->first();

        if ($user) {
            Auth::login($user);
        } else {
            $newUser = new User();
            $newUser->name = $response_user->name;
            $newUser->email = $response_user->email;
            $newUser->password = bcrypt(Str::random(16));
            $newUser->email_verified_at = now();
            $newUser->save();
            Auth::login($newUser);
        }

        $request->session()->regenerate();
        // Redirect to the intended URL
        return redirect(session('url.intended'));
    })->name('facebookCallback');
});


Route::middleware(['domain.redirect', 'analytics'])->group(function () {

    /* -------------------------------- Fortify Starts -------------------------------- */

    require_once __DIR__ . '/fortify.php';

    /* ------------------------------ Fortify Ends ------------------------------ */

    // Homepage.
    Route::get('/', function () {
        $testimonials = Testimonial::get();
        return view('thanks-giving', compact('testimonials'));
        // Main page
        // return view('welcome', compact('testimonials'));
    })->middleware('guest')->name('homePage');


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

    // Route::get('blogs', function () {
    //     return view('blogs.listings');
    // });

    // Route::get('blogs/{post_id}/{post_title}', function () {
    //     return view('blogs.show');
    // });

    /* ---------------------------------- Event --------------------------------- */

    // Create Shareable Event
    Route::post('event/create-shareable-event', [EventController::class, 'store'])->name('event.create');

    // Preview & Share
    Route::get('event/{event_id}', [EventController::class, 'show'])->name('event.preview');

    // Reaction
    Route::post('event/reaction', [EventController::class, 'react'])->name('event.reaction');

    // Embed
    Route::get('event/embed/{event_id}', [EventController::class, 'index'])->name('event.embed');

    /* ----------------------------- Advanced Event ----------------------------- */

    Route::get('advanced-event', function () {
        return view('advanced-event');
    })->name('advanced-event');

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

        if (auth()->check() && auth()->user()->hasRole('super_admin')) {
            SitemapGenerator::create(env('APP_URL'))->writeToFile('sitemap.xml');

            return 'Sitemap generated successfully!';
        }

        redirect('404');
    });
    /* --------------------------- Error Page Preview --------------------------- */

    Route::get('/errors/{code}', function ($code) {
        $error_codes = [401, 402, 403, 404, 419, 429, 500, 503];

        if (in_array($code, $error_codes)) {
            return view('errors.' . $code);
        } else {
            redirect('404');
        }
    });

    /* ------------------------------ Event Search ------------------------------ */

    Route::get('/events', EventSearch::class)->name('search');

    /* ------------------------- Fully customizable 404 ------------------------- */

    Route::get('404', function () {
        return view('errors.404');
    });

    Route::fallback(function () {
        return redirect('404');
    });

    Route::get('/checkout/{slug}', function (Request $request) {
        $plan = Plan::where('slug', $request->slug)->first();

        if (empty($plan)) {
            $plan = Plan::where('type', $request->slug)->firstOrFail();
        }

        $activePlan = Subscription::where('user_id', $request->user()->id)->where('stripe_status', 'active')->first();
        $lifetime = Transaction::where('user_id', $request->user()->id)
            ->where('type', 'lifetime')
            ->where('status', 'completed')
            ->exists();

        if ($lifetime && $plan->type !== 'extra_token' && $plan->type !== 'lifetime') {
            Notification::make()
                ->title("Unable to downgrade!")
                ->body("You have a lifetime subscription. You can't downgrade to the $plan->name.")
                ->danger()
                ->send()
                ->persistent()
                ->sendToDatabase($request->user());

            return redirect('/dashboard/subscription');
        } else {
            if ($plan->type != 'free') {
                $transaction = Transaction::create([
                    'user_id' => $request->user()->id,
                    'type' => $plan->type,
                    'amount' => $plan->price,
                    'status' => 'incomplete',
                    'reference' => Transaction::generateTransactionReference(),
                ]);
            }

            if ($plan->type == 'extra_token' || $plan->type == 'lifetime') {
                return $request->user()
                    ->checkout([$plan->stripe_price_id => 1], [
                        'success_url' => route('checkout-success'),
                        'cancel_url' => route('checkout-cancel'),
                        'metadata' => ['order_type' => $plan->type, 'transaction_id' => $transaction->id],
                    ]);
            } elseif ($plan->type == 'free' && $activePlan) {
                if ($request->downgrade) {

                    $request->user()->subscription($activePlan->type)->cancel();
                    // Get the ending date of the subscription
                    $ending = $request->user()->subscription($activePlan->type)->ends_at->format('d M, Y');

                    Notification::make()
                        ->title("Successful downgrade!")
                        ->body("You have successfully downgraded to the free plan. Your subscription will remain active till $ending.")
                        ->success()
                        ->send()
                        ->persistent()
                        ->sendToDatabase($request->user());
                    return redirect('/dashboard/subscription');
                } else {
                    return redirect()->route('downgrade-confirmation', ['slug' => $plan->slug]);
                }
            } elseif ($plan->type == 'yearly' || $plan->type == 'monthly') {
                return $request->user()
                    ->newSubscription($plan->slug, $plan->stripe_price_id)
                    ->allowPromotionCodes()
                    ->checkout([
                        'success_url' => route('checkout-success'),
                        'cancel_url' => route('checkout-cancel'),
                        'metadata' => ['order_type' => $plan->type, 'transaction_id' => $transaction->id],
                    ]);
            }
        }
    })->name('checkout');

    Route::get('checkout-cancel', function () {
        Notification::make()
            ->title('Failed')
            ->body('Unable to process transaction.')
            ->danger()
            ->send()
            ->persistent();

        return redirect('/dashboard/subscription');
    })->name('checkout-cancel');

    Route::get('checkout-success', function () {
        Notification::make()
            ->title('Payment Processed!')
            ->body('You will receive an update on the status shortly.')
            ->success()
            ->send()
            ->persistent();

        return redirect('/dashboard/subscription');
    })->name('checkout-success');

    Route::get('downgrade-confirmation', function (Request $request) {
        $plan = Plan::where('slug', $request->slug)->firstOrFail();
        return view('downgrade-confirmation', compact('plan'));
    })->name('downgrade-confirmation');
});
