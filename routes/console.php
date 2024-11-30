<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use function Laravel\Prompts\confirm;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('delete:blogs', function () {
    // Use Laravel Prompt to ask the user for confirmation
    $confirmed = confirm(
        label: "Do you want to delete all records from 'blog posts' and 'tags' tables?",
        default: false,
        yes: 'Yes, delete all records',
        no: 'No, keep the records',
        hint: 'This action cannot be undone.'
    );

    // Process the user's response
    if ($confirmed) {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('taggables')->truncate(); // Truncate pivot table first
        DB::table('posts')->truncate();     // Truncate posts table
        DB::table('tags')->truncate();      // Truncate tags table
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "All records from 'posts', 'tags', and 'taggables' tables have been deleted.\n";
    } else {
        echo "No records were deleted.\n";
    }
})->purpose('Delete all records from the "posts" and "tags" tables');
