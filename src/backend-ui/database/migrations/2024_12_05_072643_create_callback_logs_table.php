<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('callback_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incoming_log_id');
            $table->string('result');
            $table->enum('status', ['pending', 'confirmed']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callback_logs');
    }
};
