<?php

use App\Models\Ride;
use App\Models\Trip;
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
        // Schema::create('bookings', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('booking_number')->unique();
        //     $table->integer('seats_reserved');
        //     $table->integer('total_price');
        //     $table->enum('status', ['pending','confirmed','cancelled','refunded']); // Statut du trajet (pending, completed, canceled)
        //     $table->foreignIdFor(Ride::class);
        //     $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
        //     $table->timestamps();
        // });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->integer('seats_reserved');
            $table->integer('total_price');
            $table->foreignIdFor(Ride::class);
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'confirmed', 'refunded', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};