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
            $table->foreignId('user_id');
            $table->foreignId('bucket_id');
            $table->foreignId('job_id');
            $table->foreignId('payment_id');
            $table->boolean('isFilled')->default(false);;
            $table->string('fullName')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('email')->nullable(true);
            $table->boolean('attendance')->default(false);;
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
