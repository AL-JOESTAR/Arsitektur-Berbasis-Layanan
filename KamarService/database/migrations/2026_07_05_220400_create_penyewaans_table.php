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
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("penyewa_id");

            $table->foreignId("kamar_id")
            ->constrained('kamars')
            ->cascadeOnDelete();
            
            $table->date("start");
            $table->date("end");
            $table->enum("status_sewa",['Pending', 'Aktif', 'Batal', 'Selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
