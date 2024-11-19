<?php

use App\Models\Booking;
use App\Models\RideRequest;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->foreignIdFor(Booking::class)->nullable();
            $table->foreignIdFor(RideRequest::class)->nullable();
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->enum('reviewer_type', ['passenger', 'driver']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};