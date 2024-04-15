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
        Schema::create('postulations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('adviser')->nullable();
            $table->enum('status', [
                'Subiendo archivos',
                'Pendiente de revisión',
                'Aceptado en la Dirección de Investigación e Innovación',
                'Denegado en la Dirección de Investigación e Innovación',
                'Aprobado en el Consejo Universitario',
                'Denegado en el Consejo Universitario'
            ])->default('Subiendo archivos');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('announcement_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulations');
    }
};
