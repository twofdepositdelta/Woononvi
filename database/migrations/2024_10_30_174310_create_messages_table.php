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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade'); // La conversation à laquelle appartient le message
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // L'utilisateur qui envoie le message
            $table->text('content')->nullable(); // Contenu du message
            $table->string('file_path')->nullable(); // Chemin du fichier téléchargé
            $table->enum('status', ['sent', 'received', 'read'])->default('sent'); // Statut du message pour suivi
            $table->boolean('is_read')->default(false); // Indique si le message a été lu ou non
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};