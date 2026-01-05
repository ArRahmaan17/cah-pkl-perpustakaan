<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman');

            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('petugas'); // relasi ke user

            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->date('tanggal_dikembalikan')->nullable();

            $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat']);
            $table->integer('denda')->default(0);

            $table->timestamps();

            // Foreign Key
            $table->foreign('buku_id')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->foreign('anggota_id')->references('id_anggota')->on('anggota')->onDelete('cascade');
            $table->foreign('petugas')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
