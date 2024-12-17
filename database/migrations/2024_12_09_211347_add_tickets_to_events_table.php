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
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_paid')->default(false)->after('status'); // Whether the event is paid
            $table->json('ticket_levels')->nullable()->after('is_paid'); // Stores ticket levels as JSON
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('is_paid');
            $table->dropColumn('ticket_levels');
        });
    }
};
