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
        Schema::create('aset', function (Blueprint $table) {
            $table->id('id_aset');
            $table->string('kode_aset');
            $table->unsignedBigInteger('id_kategori');
            $table->string('kode_kabin');
            $table->text('merk')->nullable();
            $table->string('nopol');
            $table->text('serial_number')->nullable();
            $table->date('tanggal_pembelian')->nullable();
            $table->integer('harga_perolehan')->nullable();
            $table->text('asuransi')->nullable();
            $table->string('user')->nullable();
            $table->unsignedBigInteger('id_lokasi');
            $table->unsignedBigInteger('id_home_base');
            $table->enum('status', array('Tersedia', 'On Duty', 'On Service', 'Rusak', 'Terjual'));
            $table->unsignedBigInteger('id_grade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};
