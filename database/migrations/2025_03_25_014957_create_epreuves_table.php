<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('epreuves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evenement_id')->constrained('evenements')->onDelete('cascade');
            $table->string('nom');
            $table->decimal('tarif', 8, 2);
            $table->enum('genre', ['male', 'female','mixte']);
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->dateTime('inscription_date_debut');
            $table->dateTime('inscription_date_fin');
            $table->boolean('publier_resultat')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epreuves');
    }
};
