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
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campeonato_id');
            $table->enum('fase', ['quartas', 'semifinais', 'final', 'terceiro_lugar']);
            $table->unsignedBigInteger('time_casa_id');
            $table->unsignedBigInteger('time_visitante_id');
            $table->integer('placar_casa')->nullable();
            $table->integer('placar_visitante')->nullable();
            $table->unsignedBigInteger('vencedor_id')->nullable();
            $table->timestamp('data_jogo')->nullable();
            $table->timestamps();

            $table->foreign('campeonato_id')->references('id')->on('campeonatos');
            $table->foreign('time_casa_id')->references('id')->on('times');
            $table->foreign('time_visitante_id')->references('id')->on('times');
            $table->foreign('vencedor_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
