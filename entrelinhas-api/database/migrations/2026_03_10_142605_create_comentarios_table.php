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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->text('conteudo');

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Polimórfico
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');

            $table->enum('status', ['visivel', 'oculto', 'denunciado'])->default('visivel');
            $table->timestamps();
        });
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'commentable');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
