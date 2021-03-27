<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('spp');
        Schema::create('spp', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->foreignId('tahun_id')->constrained('tahun');
            $table->enum('tipe', ['Bulanan', 'Bebas']);
            $table->double('nominal');
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
        Schema::dropIfExists('spp');
    }
}
