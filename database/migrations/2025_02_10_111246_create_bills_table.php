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
        Schema::create('bills', function (Blueprint $table) {
            $table->id(); // Kolom ID otomatis (primary key, auto-increment)
            $table->string('no_invoice')->unique(); // Nomor invoice, unique
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Foreign key ke tabel clients, relasi one-to-many, onDelete cascade
            $table->enum('subscribe_type', ['Bulanan', 'Tahunan']); // Tipe berlangganan: Bulanan atau Tahunan
            $table->enum('payment_status', ['Paid', 'Not Paid'])->default('Not Paid'); // Status pembayaran: Paid atau Not Paid, default Not Paid
            $table->integer('amount'); // Total tagihan (dalam Rupiah, misalnya)
            $table->timestamps(); // Kolom timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};