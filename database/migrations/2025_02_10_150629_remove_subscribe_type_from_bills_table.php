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
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('subscribe_type'); // Hapus kolom subscribe_type dari tabel bills
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->enum('subscribe_type', ['Bulanan', 'Tahunan'])->nullable()->after('client_id'); // Jika rollback, tambahkan kembali (opsional, setelah client_id)
        });
    }
};