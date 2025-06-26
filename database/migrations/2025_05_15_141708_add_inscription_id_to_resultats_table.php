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
    Schema::table('resultats', function (Blueprint $table) {
        $table->unsignedBigInteger('inscription_id')->nullable();

        $table->foreign('inscription_id')
              ->references('id')
              ->on('inscriptions')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resultats', function (Blueprint $table) {
            //
        });
    }
};
