<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buku_onlines', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penerbit');
            $table->string('pengarang');
            $table->integer('stok_buku');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('deskripsi')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('pdf_file'); // Kolom untuk menyimpan nama file PDF
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buku_onlines');
    }
};
