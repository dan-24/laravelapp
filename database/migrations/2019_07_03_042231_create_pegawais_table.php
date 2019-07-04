<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_jabatan');
            $table->text('keterangan');
            $table->timestamps();
        });

        Schema::create('pegawais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('piket_id');
            $table->foreign('piket_id')->references('id')->on('pikets');
            $table->unsignedBigInteger('jabatan_id');
            $table->foreign('jabatan_id')->references('id')->on('jabatans');
            $table->string('nama');
            $table->text('alamat');
            $table->boolean('gender');
            $table->string('no_telphone');
            $table->date('tgl_lahir');
            $table->boolean('pernikahan');
            $table->smallInteger('jumlah_anak')->default(0);
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
        Schema::dropIfExists('jabatans');
        Schema::dropIfExists('pegawais');
    }
}
