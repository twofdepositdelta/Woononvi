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
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->id();
            $table->string('departure');
            $table->string('destination');
            $table->timestamp('preferred_time'); // Heure de départ prévue
            $table->integer('preferred_amount'); // Nombre de places disponibles
            $table->enum('status', ['pending', 'responded','completed','refunded', 'cancelled'])->default('pending'); // Statut du trajet (pending, completed, canceled)
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_requests');
    }
};
