<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class FreeMonthlyTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:free-monthly-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give all users 10 tokens every month.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve all users
        $users = User::all();

        foreach ($users as $user) {
            // Check if the user has a wallet
            if ($user->wallet) {
                // Add 10 tokens to the user's wallet balance 6
                $user->wallet->free_tokens = 10;
                $user->wallet->save();

                $this->info('Gave 10 tokens to user ID: ' . $user->id);
            } else {
                $this->info('User ID ' . $user->id . ' does not have a wallet.');
            }
        }

        $this->info('All users have been processed.');
    }
}
