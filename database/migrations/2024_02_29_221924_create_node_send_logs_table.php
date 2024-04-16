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
        Schema::create('node_send_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_id')->references('id')->on('nodes')->onUpdate('cascade')->onDelete('cascade');
            // $table->dateTime('send_time', $precision = 6)->nullable();
            // $table->dateTime('receipt_time', $precision = 6)->nullable();
            $table->integer('delay')->nullable();
            $table->integer('jitter')->nullable();
            $table->integer('sensor_read_count')->nullable();
            $table->integer('data_send_count')->nullable();
            $table->integer('payload_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_send_logs');
    }
};
