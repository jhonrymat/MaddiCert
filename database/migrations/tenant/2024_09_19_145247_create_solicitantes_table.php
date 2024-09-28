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
        Schema::create('solicitantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nombre_1', 100);
            $table->string('nombre_2', 100)->nullable();
            $table->string('apellido_1', 100);
            $table->string('apellido_2', 100);
            $table->string('correoElectronico', 100)->unique();
            $table->string('telefonoContacto', 20);
            $table->unsignedBigInteger('id_tipoSolicitante');
            $table->unsignedBigInteger('id_tipoDocumento');
            $table->string('numeroIdentificacion', 50)->unique();
            $table->string('ciudadExpedicion', 100);
            $table->timestamp('fechaNacimiento');
            $table->unsignedBigInteger('id_nivelEstudio')->nullable();
            $table->unsignedBigInteger('id_genero')->nullable();
            $table->string('ocupacion', 100)->nullable();
            $table->timestamps();

            // Relación con otras tablas
            $table->foreign('id_tipoSolicitante')->references('id')->on('tsolicitantes');
            $table->foreign('id_tipoDocumento')->references('id')->on('tdocumentos');
            $table->foreign('id_nivelEstudio')->references('id')->on('nestudios');
            $table->foreign('id_genero')->references('id')->on('generos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitantes');
    }
};
