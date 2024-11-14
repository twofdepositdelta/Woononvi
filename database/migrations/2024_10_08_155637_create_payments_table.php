<?php

use App\Models\Booking;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('total_price'); // Heure de départ prévue
            $table->enum('payment_method', ['credit_card', 'paypal', 'cash', 'momo'])->default('momo'); // Statut du trajet (pending, completed, canceled)
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Statut du trajet (pending, completed, canceled)
            $table->foreignIdFor(Booking::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};