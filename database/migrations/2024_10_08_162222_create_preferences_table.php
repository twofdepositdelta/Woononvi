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
        Schema::create('preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Clé étrangère vers la table users
            $table->boolean('smoking_allowed')->default(true);   // Si fumer est autorisé
            $table->enum('music_preference', ['none', 'soft', 'loud', 'all'])->default('all'); // Préférence musicale
            $table->boolean('pet_allowed')->default(true);       // Si les animaux sont autorisés
            $table->text('other_preferences')->nullable();        // Autres préférences
            $table->double('prefered_amount');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};