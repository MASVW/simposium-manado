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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName', 100)->nullable(false);
            $table->string('lastName', 100)->nullable(false);
            $table->date('birthDate')->nullable();
            $table->string('password')->nullable(false);
            $table->boolean('isAdmin')->default(false);
            $table->string('emaiNl')->nullable(false)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
