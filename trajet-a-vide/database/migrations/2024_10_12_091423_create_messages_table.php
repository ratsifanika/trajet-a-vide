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
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Référence à la réservation
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Expéditeur
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Destinataire
            $table->text('content'); // Contenu du message
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
