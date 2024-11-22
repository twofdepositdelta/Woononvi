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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'utilisateur qui initie la conversation
            $table->foreignId('support_id')->nullable()->constrained('users')->onDelete('cascade'); // Le support qui répond
            $table->boolean('is_taken')->default(false);
            $table->enum('status', ['open', 'resolved', 'closed'])->default('open'); // Statut de la conversation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
