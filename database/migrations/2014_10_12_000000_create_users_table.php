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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('kode_user');
            $table->string('nis');
            $table->string('fullname');
            $table->string('username');
            $table->string('password')->nullable();
            $table->string('kelas');
            $table->string('alamat');
            $table->string('verif');
            $table->string('join_date');
            $table->string('terakhir_login');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
