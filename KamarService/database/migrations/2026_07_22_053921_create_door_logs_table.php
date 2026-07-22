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
        Schema::create('door_logs', function (Blueprint $table) {
            $table->id();
             $table->foreignId('reader_id')
        ->constrained('readers');

    $table->unsignedBigInteger('user_id');

    $table->timestamp('scan_time');

    $table->enum('access_result',[
        'allow',
        'deny'
    ]);

    $table->enum('reason',[
        'success',
        'user_inactive',
        'card_invalid'
    ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_logs');
    }
};
