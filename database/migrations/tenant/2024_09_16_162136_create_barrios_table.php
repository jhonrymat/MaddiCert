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
        Schema::create('barrios', function (Blueprint $table) {
            $table->id();
            $table->string('nombreBarrio', 100);
            $table->string('upz', 50);
            $table->string('tipo', 50);
            $table->string('sector', 50);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barrios');
    }
};
