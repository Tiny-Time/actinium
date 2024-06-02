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
        Schema::create('event_report_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_report_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('response');
            $table->timestamps();

            $table->foreign('event_report_id')->references('id')->on('event_reports')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_report_responses');
    }
};
