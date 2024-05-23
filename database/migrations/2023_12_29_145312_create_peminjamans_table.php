<?php

// In a migration file (e.g., 2023_01_01_create_peminjamans_table.php)
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamansTable extends Migration
{
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id'); // Foreign key column for the book ID
            $table->string('judul');
            $table->string('penerbit');
            $table->string('pengarang');
            $table->integer('stok_tersisa');
            $table->string('status'); // Menghapus nullable untuk kolom 'status'
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade');
            $table->unsignedBigInteger('siswa_id');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('peminjamans');
    }
}

