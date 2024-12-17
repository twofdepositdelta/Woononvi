<?php

use App\Models\Ride;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->integer('seats_reserved');
            $table->double('total_price');
            $table->double('price_maintain');
            $table->integer('commission_rate');
            $table->foreignIdFor(Ride::class);
            $table->string('passenger_start_location_name');
            $table->geography('passenger_start_location', 'point');
            $table->string('passenger_end_location_name');
            $table->geography('passenger_end_location', 'point');
            $table->foreignId('passenger_passenger_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'in progress', 'accepted', 'rejected', 'validated_by_passenger', 'validated_by_driver', 'refunded', 'cancelled'])->default('pending');
            $table->boolean('is_by_passenger')->default(false);
            $table->boolean('is_by_driver')->default(false);
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('in_progress_at')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('validated_by_passenger_at')->nullable();
            $table->timestamp('validated_by_driver_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
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
