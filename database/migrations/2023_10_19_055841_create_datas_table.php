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
        Schema::create('datas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('positions_id')->references('id')->on('positions');
            $table->foreignId('users_id')->nullable(true)->references('id')->on('users');
            $table->foreignId('payments_id')->nullable(true)->references('id')->on('payments');
            $table->boolean('isFilled')->default(false);;
            $table->string('fullName')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('email')->nullable(true);
            $table->boolean('attendance')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datas');
    }
};
