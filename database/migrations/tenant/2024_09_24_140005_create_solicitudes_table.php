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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_solicitante');
            $table->string('numeroIdentificacion', 50);
            $table->unsignedBigInteger('id_barrio');
            $table->string('direccion', 100);
            $table->string('ubicacion', 100);
            $table->string('evidenciaPDF', 255);
            $table->timestamps();

            // Relación con otras tablas
            $table->foreign('id_solicitante')->references('id')->on('solicitantes');
            $table->foreign('id_barrio')->references('id')->on('barrios');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
