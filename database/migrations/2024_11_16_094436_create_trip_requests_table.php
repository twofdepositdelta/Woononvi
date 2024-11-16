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
        Schema::create('trip_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id'); // ID du trajet concerné
            $table->unsignedBigInteger('passenger_id'); // ID du passager
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); // Statut de la demande
            $table->timestamps();

            // Relations
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->foreign('passenger_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_requests');
    }
};
