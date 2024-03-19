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
        Schema::create('processed_tasks', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('title');
            $table->string('text');
            $table->string('action');
            $table->boolean('is_queued')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processed_tasks');
    }
};
