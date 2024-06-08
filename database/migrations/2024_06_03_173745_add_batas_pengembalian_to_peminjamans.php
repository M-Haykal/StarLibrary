<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('peminjamans', function (Blueprint $table) {
        $table->date('due_date')->nullable()->after('returned_at');
    });
}

public function down()
{
    Schema::table('peminjamans', function (Blueprint $table) {
        $table->dropColumn('due_date');
    });
}
};
