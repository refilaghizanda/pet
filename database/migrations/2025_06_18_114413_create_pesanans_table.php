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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_hewan');
            $table->unsignedBigInteger('id_layanan');
            $table->date('tanggal_layanan');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status_pembayaran', ['belum', 'lunas', 'pending'])->default('belum');
            $table->enum('status_pesanan', ['menunggu', 'proses', 'selesai', 'batal'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_hewan')->references('id')->on('hewans')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id')->on('layanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
