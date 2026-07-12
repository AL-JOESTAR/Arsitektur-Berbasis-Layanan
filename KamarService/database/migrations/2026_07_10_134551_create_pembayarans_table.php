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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('penyewaan_id')
            ->constrained('penyewaans')
            ->cascadeOnDelete();

            $table->dateTime('tanggal_bayar')->nullable();
            $table->enum('jenis_pembayaran',['awal', 'perpanjangan']);
            $table->integer('periode');
            $table->decimal('nominal', 12, 2)->default(0);
            $table->enum('status_bayar', ['paid', 'pending', 'cancelled']);
            $table->dateTime('jatuh_tempo');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
