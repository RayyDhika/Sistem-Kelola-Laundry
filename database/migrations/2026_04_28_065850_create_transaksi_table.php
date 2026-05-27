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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_outlet')->constrained('outlet')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_pelanggan')->constrained('pelanggan')->onDelete('cascade');

            $table->string('kode_invoice');
            $table->date('tgl_masuk');
            $table->date('batas_waktu');

            $table->enum('status', ['baru','proses','selesai','diambil'])->default('baru');
            $table->enum('status_bayar', ['belum','dibayar'])->default('belum');

            $table->decimal('diskon', 10,2)->default(0);
            $table->decimal('pajak', 10,2)->default(0);
            $table->decimal('total_harga', 10,2)->default(0);
            $table->date('tgl_bayar')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
