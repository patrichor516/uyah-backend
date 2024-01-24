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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('penerbit_buku_id')->nullable();
            $table->foreign('penerbit_buku_id')->references('id')->on('penerbit');
            $table->string('judul_buku');
            $table->string('pengarang');
            $table->string('tahun_terbit');
            $table->string('isbn');
            $table->string('buku_baik');
            $table->string('buku_rusak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
