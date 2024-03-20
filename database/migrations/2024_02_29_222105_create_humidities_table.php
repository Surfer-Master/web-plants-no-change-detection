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
        Schema::create('humidities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_send_log_id')->nullable()->references('id')->on('node_send_logs')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('humidity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('humidities');
    }
};
