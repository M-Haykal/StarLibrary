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
            $table->text('deskripsi')->nullable(); // Add description to bukus
        });

        Schema::table('peminjamans', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(); // Add description to peminjaman
        });
    }

    public function down()
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });

        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};
