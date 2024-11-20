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
            $table->string('start_location_name');
            $table->geography('start_location'); // Latitude et longitude de départ
            $table->string('end_location_name');
            $table->geography('end_location'); // Latitude et longitude d’arrivée
            $table->integer('seats');
            $table->timestamp('preferred_time'); // Heure de départ prévue
            $table->double('preferred_amount'); // Nombre de places disponibles
            $table->integer('commission_rate');
            $table->enum('status', ['pending', 'accepted', 'rejected','completed', 'refunded', 'cancelled'])->default('pending');
            $table->boolean('is_by_passenger')->default(false);
            $table->boolean('is_by_driver')->default(false);
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('validated_by_passenger_at')->nullable();
            $table->timestamp('validated_by_driver_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
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
        Schema::dropIfExists('ride_requests');
    }
};
