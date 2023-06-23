<?php

namespace App\Http\Livewire;

use Laravel\Jetstream\ConfirmsPasswords;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;

class ExtendUpdateProfileInformationForm extends UpdateProfileInformationForm
{
    use ConfirmsPasswords;

    /**
     * ExtendUpdateProfileInformation
     *
     * @param  mixed $updater
     * @return void
     */
    public function ExtendUpdateProfileInformation(UpdatesUserProfileInformation $updater){
        $this->ensurePasswordIsConfirmed();
        parent::updateProfileInformation($updater);
    }
}
