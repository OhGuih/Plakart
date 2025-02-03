<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('etapa_piloto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etapa_id')->constrained('etapas')->onDelete('cascade');
            $table->foreignId('piloto_id')->constrained('pilotos')->onDelete('cascade');
            $table->integer('posicao'); // Define a ordem de chegada
            $table->integer('pontos')->default(0); // Define os pontos, calculados automaticamente
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('etapa_piloto');
    }
};

