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
            $table->string('departure');
            $table->string('destination');
            $table->timestamp('departure_time'); // Heure de départ prévue
            $table->integer('available_seats'); // Nombre de places disponibles
            $table->integer('price_per_km');
            $table->boolean('is_nearby_ride')->default(false);
            $table->enum('status', ['active','pending', 'completed', 'cancelled','suspend'])->default('pending'); // Statut du trajet (pending, completed, canceled)
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
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
