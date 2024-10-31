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
        Schema::create('ride_searches', function (Blueprint $table) {
            $table->id();
            $table->string('departure');        // Lieu de départ recherché
            $table->string('destination');      // Lieu de destination recherché
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade'); // Utilisateur ayant effectué la recherche
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_searches');
    }
};
