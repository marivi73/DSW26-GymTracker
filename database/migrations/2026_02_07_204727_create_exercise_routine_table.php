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
        Schema::create('exercise_routine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
            $table->foreignId('routine_id')->constrained()->onDelete('cascade');
            
            $table->integer('sequence')->default(0); // para ordenar los ejercicios dentro de la rutina
            $table->integer('target_sets')->nullable();
            $table->integer('target_reps')->nullable();
            $table->integer('rest_seconds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_routine');
    }
};
