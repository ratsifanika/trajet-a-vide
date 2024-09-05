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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('carrier_id')->nullable(); // Permet à la clé étrangère d'être NULL
            $table->foreign('carrier_id')->references('id')->on('carriers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer d'abord la clé étrangère
            $table->dropForeign(['carrier_id']); 
            
            // Supprimer ensuite la colonne 'carrier_id'
            $table->dropColumn('carrier_id');
        });
    }
};
