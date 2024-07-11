<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function(Blueprint $table){
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email_address')->nullable();
            $table->string('contact_phone_number')->nullable();
            $table->string('check_in_time')->nullable();
            $table->string('event_end_time')->nullable();
            $table->boolean('guestbook')->default(false);
            $table->boolean('rsvp')->default(false);
            $table->string('post_event_massage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
