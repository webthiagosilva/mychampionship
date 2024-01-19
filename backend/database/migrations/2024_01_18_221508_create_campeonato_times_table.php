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
        Schema::create('campeonato_times', function (Blueprint $table) {
            $table->unsignedBigInteger('campeonato_id');
            $table->unsignedBigInteger('time_id');
            $table->timestamp('data_inscricao')->nullable();
            $table->integer('pontos_acumulados')->default(0);
            $table->timestamps();

            $table->primary(['campeonato_id', 'time_id']);
            $table->foreign('campeonato_id')->references('id')->on('campeonatos');
            $table->foreign('time_id')->references('id')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campeonato_times');
    }
};
