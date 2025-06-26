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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->integer('rang');  // Ranking of the participant
            $table->string('dossard');  // Bib number
            $table->string('nom');  // Last name
            $table->string('prenom');  // First name
            $table->enum('genre', ['male', 'female']);  // Gender
            $table->string('categorie');  // Category (age group, etc.)
            $table->decimal('temps', 8, 2);  // Time taken, in seconds (for example)
            $table->string('club');  // Club name
            $table->foreignId('epreuve_id')->constrained('epreuves')->onDelete('cascade');  // Foreign key to the epreuves table
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};
