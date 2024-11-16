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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['regular', 'single']); // Trajet régulier ou ponctuel
            $table->geography('start_location'); // Latitude et longitude de départ
            $table->geography('end_location'); // Latitude et longitude d’arrivée
            $table->json('days')->nullable(); // Jours pour les trajets réguliers
            $table->boolean('return_trip')->default(false); // S’il y a un retour
            $table->time('return_time')->nullable();
            $table->time('departure_time');
            $table->time('arrival_time')->nullable();
            $table->double('price_per_km');
            $table->boolean('is_nearby_ride')->default(false);
            $table->decimal('commission_rate')->default(10);
            $table->enum('status', ['active', 'pending', 'completed', 'cancelled', 'suspend'])->default('pending');
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
        Schema::dropIfExists('trips');
    }
};
