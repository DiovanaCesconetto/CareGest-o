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
        Schema::create('medicos', function (Blueprint $table) {
            
            $table->id();
            $table->string('nome');
            $table->string('especialidade')->nullable();  // permite vazio
            $table->string('whatsapp')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('endereco')->nullable();
            $table->string('crm')->nullable();
            $table->string('foto')->nullable(); // caminho da foto no storage/public
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // vincula ao usuário
            $table->timestamps();
        });
    
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
