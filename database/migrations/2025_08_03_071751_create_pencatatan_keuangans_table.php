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
        Schema::create('pencatatan_keuangans', function (Blueprint $table) {
            $table->id('id_catat');
            $table->foreignId('kategori_id')->constrained('kategori_keuangans', 'id_kategori');
            $table->longText('deskripsi');
            $table->bigInteger('nominal');
            $table->text('bukti_upload')->nullable();
            $table->foreignId('created_by')->constrained('anggotas', 'id_anggota');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_keuangans');
    }
};
