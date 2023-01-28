<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->foreignId('barang_id');
            $table->foreignId('user_id');
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Menunggu Konfirmasi', 'Dibatalkan Pembeli', 'Ditolak', 'Terkonfirmasi']);
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barangs');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
