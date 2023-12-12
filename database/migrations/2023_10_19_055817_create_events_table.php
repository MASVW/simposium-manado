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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('eventName', 255)->nullable(false);
            $table->text('excerpt')->nullable(false);
            $table->text('eventDesc')->nullable(false);
            $table-> date('eventDate')->nullable(false);
            $table->string('slug')->nullable(false)->unique();
            $table->string('img')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
