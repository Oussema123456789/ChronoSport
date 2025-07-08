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
        Schema::create('form_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('evenements')->onDelete('cascade');

            // Configuration des champs - JSON pour stocker la configuration
            $table->json('field_config')->nullable();

            // Configuration par défaut pour les nouveaux événements
            $table->boolean('is_default')->default(false);

            $table->timestamps();

            // Index pour optimiser les requêtes
            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_configurations');
    }
};
