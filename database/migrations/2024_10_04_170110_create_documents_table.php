<?php

use App\Models\User;
use App\Models\TypeDocument;
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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('paper')->nullable();
            $table->integer('number')->nullable();
            $table->date('expiry_date');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(TypeDocument::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_documents');
    }
};
