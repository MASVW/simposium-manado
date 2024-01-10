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
        Schema::create('buckets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('prices_id')->nullable(true)->references('id')->on('prices');
            $table->foreignId('events_id')->nullable(true)->references('id')->on('events');
            $table->foreignId('payments_id')->nullable(true)->references('id')->on('payments');
            $table->foreignId('datas_id')->nullable(true)->references('id')->on('datas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buckets');
    }
};
