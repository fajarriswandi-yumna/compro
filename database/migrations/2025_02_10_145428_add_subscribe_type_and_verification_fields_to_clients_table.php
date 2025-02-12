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
        Schema::table('clients', function (Blueprint $table) {
            $table->enum('subscribe_type', ['Bulanan', 'Tahunan'])->nullable()->after('institution'); // Tambahkan subscribe_type
            $table->string('email_verification_token')->nullable()->after('no_phone'); // Tambahkan token verifikasi email
            $table->timestamp('email_verified_at')->nullable()->after('email_verification_token'); // Tambahkan timestamp verifikasi email
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['subscribe_type', 'email_verification_token', 'email_verified_at']); // Rollback: drop kolom jika diperlukan
        });
    }
};