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
        Schema::create('grade', function (Blueprint $table) {
            $table->id('id_grade');
            $table->string('nama_grade');
            $table->unsignedBigInteger('depan_kanan_1')->nullable();
            $table->unsignedBigInteger('depan_kanan_2')->nullable();
            $table->unsignedBigInteger('depan_kiri_1')->nullable();
            $table->unsignedBigInteger('depan_kiri_2')->nullable();
            $table->unsignedBigInteger('tengah_kanan_luar_1')->nullable();
            $table->unsignedBigInteger('tengah_kanan_luar_2')->nullable();
            $table->unsignedBigInteger('tengah_kanan_dalam_1')->nullable();
            $table->unsignedBigInteger('tengah_kanan_dalam_2')->nullable();
            $table->unsignedBigInteger('tengah_kiri_luar_1')->nullable();
            $table->unsignedBigInteger('tengah_kiri_luar_2')->nullable();
            $table->unsignedBigInteger('tengah_kiri_dalam_1')->nullable();
            $table->unsignedBigInteger('tengah_kiri_dalam_2')->nullable();
            $table->unsignedBigInteger('belakang_kanan_luar_1')->nullable();
            $table->unsignedBigInteger('belakang_kanan_luar_2')->nullable();
            $table->unsignedBigInteger('belakang_kanan_dalam_1')->nullable();
            $table->unsignedBigInteger('belakang_kanan_dalam_2')->nullable();
            $table->unsignedBigInteger('belakang_kiri_luar_1')->nullable();
            $table->unsignedBigInteger('belakang_kiri_luar_2')->nullable();
            $table->unsignedBigInteger('belakang_kiri_dalam_1')->nullable();
            $table->unsignedBigInteger('belakang_kiri_dalam_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade');
    }
};
