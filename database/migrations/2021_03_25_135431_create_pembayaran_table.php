<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pembayaran');
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_pembayaran');
            $table->foreignId('tagihan_id')->constrained('tagihan')->onDelete('cascade');
            $table->double('jumlah');
            $table->integer('bulan_ke');
            $table->foreignId('user_id')->constrained('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
