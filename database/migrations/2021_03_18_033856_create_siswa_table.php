<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('siswa');
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 191)->unique();
            $table->string('nis', 191)->unique();
            $table->string('nama', 255);
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->enum('kelamin', ['L', 'P']);
            $table->string('telp')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->text('avatar')->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('siswa');
    }
}
