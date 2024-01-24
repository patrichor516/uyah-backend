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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('judul_buku_id')->nullable();
            $table->foreign('judul_buku_id')->references('id')->on('buku');
            $table->string('nama_anggota');
            $table->string('tanggal_peminjaman');
            $table->string('tanggal_pengembalian');
            $table->string('kondisi_buku_saat_dipinjam');
            $table->string('kondisi_buku_saat_dikembalikan');
            $table->string('denda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
