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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('no_phone');
            $table->string('photo_profile')->nullable(); // Opsional, bisa NULL
            $table->string('institution')->nullable(); // Opsional, bisa NULL
            $table->enum('subscribe_status', ['Aktif', 'Non Aktif'])->default('Non Aktif'); // ENUM untuk status
            $table->date('subscription_start_date')->nullable(); // Opsional, bisa NULL
            $table->date('subscription_end_date')->nullable();   // Opsional, bisa NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};