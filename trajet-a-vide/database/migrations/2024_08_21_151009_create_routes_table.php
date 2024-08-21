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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrier_id')->constrained()->onDelete('cascade'); // Relation avec Carrier
            $table->foreignId('departure_city_id')->constrained('cities')->onDelete('cascade'); // Relation avec City
            $table->foreignId('arrival_city_id')->constrained('cities')->onDelete('cascade');   // Relation avec City
            $table->dateTime('departure_date_time');
            $table->decimal('price_per_passenger', 8, 2);
            $table->integer('available_seats');
            $table->text('remarks')->nullable();
            $table->foreignId('car_id')->constrained()->onDelete('cascade'); // Relation avec Car
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
