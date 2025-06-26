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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('epreuve_id'); // 🔹 Add this line
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->date('date_naissance')->nullable();   // optional
            $table->string('cin')->nullable();             // optional
            $table->string('genre')->nullable();           // optional
            $table->string('nationalite')->nullable();     // optional
            $table->string('club')->nullable();            // optional
            $table->timestamps();

            // Add the foreign key constraint
            $table->foreign('epreuve_id')->references('id')->on('epreuves')->onDelete('cascade');
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
