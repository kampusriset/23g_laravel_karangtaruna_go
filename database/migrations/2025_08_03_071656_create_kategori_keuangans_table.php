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
        Schema::create('kategori_keuangans', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori', 50);
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->enum('status_uang', ['debit', 'kredit']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_keuangans');
    }
};
