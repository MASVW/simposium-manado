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
        Schema::table('infos', function (Blueprint $table) {
            $table->foreignId('users_id')->after('info')->nullable(true)->references('id')->on('users');
            $table->string('message', 2048)->after('users_id')->nullable();
            $table->string('phone')->after('message')->nullable();
            $table->string('email')->after('phone')->nullable();
            $table->string('name')->after('phone')->nullable();
        });
    }

    /**p
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('infos', function (Blueprint $table) {
            //
        });
    }
};
