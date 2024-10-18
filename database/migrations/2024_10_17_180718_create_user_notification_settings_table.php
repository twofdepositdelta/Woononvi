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
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Lier aux utilisateurs
            $table->string('notification_type'); // Type de notification
            $table->boolean('is_enabled')->default(true); // État de la notification
            $table->enum('frequency', ['immédiat', 'quotidien', 'hebdomadaire', 'jamais'])->default('immédiat'); // Fréquence des notifications
            $table->timestamps(); // Pour created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_notification_settings');
    }
};