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
        Schema::create('trip_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id');
            $table->enum('stage', ['not_started', 'in_progress', 'completed', 'validated_by_passenger', 'validated_by_driver']);
            $table->timestamps();

            // Relations
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_stages');
    }
};
