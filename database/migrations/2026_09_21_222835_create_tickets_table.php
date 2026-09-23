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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departament_id')
                ->constrained('departments')
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('requester_name');
            $table->enum('priority', ['Baixa', 'Média', 'Alta', 'Urgente'])
                ->default('Baixa');
            $table->text('description');
            $table->enum('status', ['Aberto', 'Em Atendimento', 'Concluído'])
                ->default('Aberto');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
