<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->bigInteger('harga')->default(0); // Tambahkan kolom harga dengan tipe bigint
        });
    }

    public function down()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropColumn('harga'); // Rollback: hapus kolom harga
        });
    }
};
