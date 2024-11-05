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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Identifiants de l'utilisateur et du conducteur
            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            // Trajet associé
            $table->foreignId('ride_id')->constrained('rides')->onDelete('cascade');
            // Détails de la transaction
            $table->decimal('amount', 10, 2); // Montant de la transaction
            $table->decimal('platform_fee', 10, 2);
            $table->decimal('commission', 10, 2)->nullable(); // Commission de l'application, si applicable
            $table->enum('status', ['pending', 'completed', 'cancelled', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable(); // Méthode de paiement utilisée (par ex. carte, mobile money)
            $table->string('transaction_reference')->unique(); // Référence de la transaction pour suivi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
