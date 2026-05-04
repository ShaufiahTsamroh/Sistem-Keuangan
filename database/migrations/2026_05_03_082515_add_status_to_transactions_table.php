<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        // Menambah kolom status dengan pilihan: pending, proses, selesai, ditolak
        // Default-nya pending karena setiap transaksi baru harus direview Admin dulu
        $table->enum('status', ['pending', 'proses', 'selesai', 'ditolak'])->default('pending');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        // Menghapus kolom status kalau migration di-rollback
        $table->dropColumn('status');
    });
}
};