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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_registro', ['interno', 'visita', 'adm'])->default('interno');
            $table->string('nome');
            $table->string('motivo');
            $table->dateTime('hr_entrada')->nullable();
            $table->dateTime('hr_saida')->nullable();
            $table->string('porteiro');
            $table->text('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
