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
    Schema::create('m_barang', function (Blueprint $table) {
        $table->id('barang_id');
        $table->unsignedBigInteger('kategori_id');
        $table->unsignedBigInteger('supplier_id');
        $table->string('barang_kode', 20)->unique();
        $table->string('barang_nama', 100);
        $table->integer('harga_jual');
        $table->timestamps();

        $table->foreign('kategori_id')
              ->references('kategori_id')
              ->on('m_kategori');

        $table->foreign('supplier_id')
              ->references('supplier_id')
              ->on('m_supplier');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};
