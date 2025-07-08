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
        Schema::table('inscriptions', function (Blueprint $table) {
            // Rendre tous les champs configurables nullable
            $table->string('nom')->nullable()->change();
            $table->string('prenom')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('telephone')->nullable()->change();
            $table->date('date_naissance')->nullable()->change();
            $table->string('cin')->nullable()->change();
            $table->string('genre')->nullable()->change();
            $table->string('nationalite')->nullable()->change();
            // club est déjà nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            // Remettre les champs comme non-nullable (attention : peut échouer s'il y a des NULL)
            $table->string('nom')->nullable(false)->change();
            $table->string('prenom')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('telephone')->nullable(false)->change();
            $table->date('date_naissance')->nullable(false)->change();
            $table->string('cin')->nullable(false)->change();
            $table->string('genre')->nullable(false)->change();
            $table->string('nationalite')->nullable(false)->change();
        });
    }
};
