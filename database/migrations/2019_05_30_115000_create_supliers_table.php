<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_perusahaan');
            $table->string('nama_agen')->nullabe();
            $table->string('no_telphone')->nullabe();
            $table->string('email')->nullabe();
            $table->string('kota')->nullabe();
            $table->string('provinsi')->nullabe();
            $table->text('alamat')->nullabe();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('supliers');
    }
}
