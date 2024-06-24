<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->decimal('tokens', 15, 2)->default(0);
            $table->enum('type', ['free', 'extra_token', 'yearly', 'monthly', 'lifetime'])->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('plans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
