<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('name');
            $table->decimal('budget', 9, 2);
            $table->string('adviser')->nullable();
            $table->uuid('uuid')->unique();
            $table->dateTime('editable_up_to')->nullable();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('announcement_id')->constrained();
            $table->foreignId('activity_id')->constrained();
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
