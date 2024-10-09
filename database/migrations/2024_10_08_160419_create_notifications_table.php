<?php

use App\Models\Ride;
use App\Models\User;
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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Ride::class);
            $table->enum('notification_type', ['ride_update', 'new_ride_available', 'demand_ride_response']); // Statut du trajet (pending, completed, canceled)
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};