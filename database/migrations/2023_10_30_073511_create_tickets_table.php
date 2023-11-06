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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('msg_id'); // From wa baileys
            $table->string('ticket_number');
            $table->string('phone_number');
            $table->string('push_name');
            $table->datetime('start_time');
            $table->datetime('end_time')->nullable();
            $table->string('status')->default('Open'); // Open / Close
            $table->string('pic')->nullable();
            $table->datetime('pic_time')->nullable();
            $table->string('rate')->nullable(); // 1,2,3,4,5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

