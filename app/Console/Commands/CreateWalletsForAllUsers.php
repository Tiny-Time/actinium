<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;

class CreateWalletsForAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-wallets-for-all-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create wallets for all users if they don\'t already have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (!$user->wallet) {
                Wallet::create([
                    'user_id' => $user->id,
                    'free_tokens' => 10.00,
                ]);

                $this->info('Created wallet for user ID: ' . $user->id);
            } else {
                $this->info('User ID ' . $user->id . ' already has a wallet.');
            }
        }

        $this->info('All users have been processed.');
    }
}
