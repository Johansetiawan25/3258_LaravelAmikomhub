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
        Schema::table('organizers', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizers', function (Blueprint $table) {

            $table->dropColumn([
                'email',
                'password',
                'remember_token',
                'status'
            ]);
        });
    }
};
