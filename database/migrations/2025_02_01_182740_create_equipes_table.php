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
        if (!Schema::hasTable('pilotos')) {
            throw new \Exception('A tabela "pilotos" precisa ser criada antes da "equipes".');
        }
    
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('campeonato_id')->constrained()->onDelete('cascade');
            $table->foreignId('chefe_id')->nullable()->constrained('pilotos')->onDelete('set null');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipes');
    }
};
