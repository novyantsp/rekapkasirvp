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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->integer('jenis_transaksi');
            $table->bigInteger('nominal_transaksi');
            $table->string('keterangan_transaksi');
            $table->unsignedBigInteger('sesi_id');
            $table->foreign('sesi_id')->references('id')->on('sesis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');

    }
};
