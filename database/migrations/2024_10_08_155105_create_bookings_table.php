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
            $table->integer('commission_rate');
            $table->foreignIdFor(Ride::class);
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'validated_by_passenger', 'validated_by_driver', 'refunded', 'cancelled'])->default('pending');
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
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
