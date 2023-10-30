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
        Schema::create('detail_ban', function (Blueprint $table) {
            $table->id('id_detail_ban');
            $table->unsignedBigInteger('id_barang');
            $table->text('nomor_seri');
            $table->string('stamp_ban');
            $table->integer('no_po');
            $table->string('tgl_datang');
            $table->string('tgl_pakai')->nullable();
            $table->unsignedBigInteger('id_aset')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_ban');
    }
};
