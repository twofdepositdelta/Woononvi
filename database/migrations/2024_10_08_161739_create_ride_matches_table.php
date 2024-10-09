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
        Schema::create('ride_matches', function (Blueprint $table) {
            $table->id();
            $table->enum('match_type', ['exact', 'nearby', 'alternative']); // Statut du trajet (pending, completed, canceled)
            $table->foreignIdFor(Ride::class);
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_matches');
    }
};