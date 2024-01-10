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
        Schema::table('datas', function (Blueprint $table) {
            $table->foreignId('bucket_id')->nullable(true)->references('id')->on('buckets')->after('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datas', function (Blueprint $table) {
            //
        });
    }
};
