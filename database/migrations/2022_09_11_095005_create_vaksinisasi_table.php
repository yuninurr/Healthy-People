<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaksinisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaksinisasi', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('user_id');
            $table->tinyInteger('lokasi_vaksin_id')->nullable();
            $table->tinyInteger('jenis_vaksin_id');
            $table->tinyInteger('rumah');
            $table->tinyInteger('provinsi_id');
            $table->tinyInteger('dokter_id')->nullable();
            $table->string('kode_vaksinisasi', 10)->nullable();
            $table->date('tanggal');
            $table->tinyInteger('gelombang_vaksin');
            $table->tinyInteger('no_antrian');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('vaksinisasi');
    }
}
