<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

class CustomRegisteredUserController extends RegisteredUserController
{
    /**
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    public function create(Request $request): RegisterViewResponse
    {
        if ($request->has('notification')) {
            // Notify the user to complete the registration form to access the event
            Notification::make()
                ->title('Complete Registration!')
                ->body('Please complete the registration form to access the event.')
                ->success()
                ->persistent()
                ->send();
        }

        return app(RegisterViewResponse::class);
    }
}
