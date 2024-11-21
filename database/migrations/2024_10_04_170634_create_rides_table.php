<?php

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ride')->unique();
            $table->enum('type', ['regular', 'single']); // Trajet régulier ou ponctuel
            $table->string('start_location_name');
            $table->geography('start_location', 'point'); // Latitude et longitude de départ
            $table->string('end_location_name');
            $table->geography('end_location', 'point'); // Latitude et longitude d’arrivée
            $table->json('days')->nullable(); // Jours pour les trajets réguliers
            $table->boolean('return_trip')->default(false); // S’il y a un retour
            $table->time('return_time')->nullable();
            $table->integer('available_seats'); // Nombre de places disponibles
            $table->time('departure_time');
            $table->time('arrival_time')->nullable();
            $table->double('price_per_km');
            $table->boolean('is_nearby_ride')->default(false);
            $table->enum('status', ['active', 'pending', 'completed', 'cancelled', 'suspend'])->default('pending');
            $table->foreignIdFor(Vehicle::class);
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            
        });

        Schema::table('table', function (Blueprint $table) {
            DB::statement("UPDATE `rides` SET `start_location` = ST_GeomFromText('POINT(0 0)', 4326);");

            DB::statement("ALTER TABLE `table` CHANGE `start_location` `start_location` POINT NOT NULL;");

            DB::statement("UPDATE `rides` SET `end_location` = ST_GeomFromText('POINT(0 0)', 4326);");

            DB::statement("ALTER TABLE `table` CHANGE `end_location` `start_location` POINT NOT NULL;");
    
            $table->spatialIndex('start_location');
            $table->spatialIndex('end_location');
        });

        // In the second go, set 0,0 values, make the column not null and finally add the spatial index
        // Schema::table('rides', function (Blueprint $table) {
            // DB::statement("UPDATE `rides` SET `start_location` = ST_GeomFromText('POINT(0 0)', 4326);");

            // DB::statement("ALTER TABLE `table` CHANGE `start_location` `start_location` POINT NOT NULL;");

        //     DB::statement("UPDATE `rides` SET `end_location` = ST_GeomFromText('POINT(0 0)', 4326);");

        //     DB::statement("ALTER TABLE `table` CHANGE `end_location` `end_location` POINT NOT NULL;");

        //     // Index
             
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
