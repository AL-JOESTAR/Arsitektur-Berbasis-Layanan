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
        Schema::create('room_type__facilities', function (Blueprint $table) {
            
            $table->foreignId('type_room_id')
            ->constrained('type_rooms')
            ->cascadeOnDelete();

            $table->foreignId('facility_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->timestamps();

            $table->primary(['type_room_id', 'facility_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_type__facilities');
    }
};
