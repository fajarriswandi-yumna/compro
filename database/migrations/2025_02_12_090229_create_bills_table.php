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
            $table->id();
            $table->string('no_invoice')->unique()->nullable(); // Tambahkan ->nullable()
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel clients
            $table->date('bill_date'); // Tanggal Tagihan
            $table->date('due_date'); // Tanggal Jatuh Tempo
            $table->enum('payment_status', ['Not Paid', 'Paid'])->default('Not Paid'); // Status Pembayaran, default 'Not Paid'
            $table->decimal('amount', 10, 2); // Jumlah Tagihan, decimal dengan 2 angka desimal
            $table->timestamps(); // created_at dan updated_at
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