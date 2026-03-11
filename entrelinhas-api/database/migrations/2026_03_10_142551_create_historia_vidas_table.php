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
        Schema::create('historias_vida', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('resumo')->nullable();
            $table->text('conteudo');
            $table->string('imagem')->nullable();
            $table->string('nome_pessoa');
            
            // Autor
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade');

            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_vidas');
    }
};
