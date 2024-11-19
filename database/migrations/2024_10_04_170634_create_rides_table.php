<?php

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->enum('type', ['regular', 'single']); // Trajet régulier ou ponctuel
            $table->geography('start_location'); // Latitude et longitude de départ
            $table->geography('end_location'); // Latitude et longitude d’arrivée
            $table->json('days')->nullable(); // Jours pour les trajets réguliers
            $table->datetime('return_time')->nullable();
            $table->datetime('departure_time');
            $table->double('price_per_km');
            $table->boolean('is_nearby_ride')->default(false);
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
        Schema::dropIfExists('rides');
    }
};