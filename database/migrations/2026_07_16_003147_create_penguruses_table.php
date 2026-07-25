<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jabatan_id')
                ->constrained('jabatans')
                ->onDelete('cascade');

            $table->string('name', 100);
            $table->string('description', 255);
            $table->decimal('salary', 15, 2);

            $table->string('created_by', 100);
            $table->timestamp('created_at')->nullable();

            $table->string('updated_by', 100)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
};