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
            $table->geography('start_location'); // Latitude et longitude de départ
            $table->geography('end_location'); // Latitude et longitude d’arrivée
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade'); // Utilisateur ayant effectué la recherche
            $table->timestamps();

            // Index
            $table->spatialIndex('start_location');
            $table->spatialIndex('end_location');
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
