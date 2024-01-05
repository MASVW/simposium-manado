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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->string('priceTag', 255)->nullable(false)->default('Please Input Price Tag');
            $table->decimal('price', 10, 2)->nullable(false)->default(0);
            $table->mediumText('priceDesc')->nullable(true);
            $table->foreignId('events_id');
            $table->foreignId('job_id')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
