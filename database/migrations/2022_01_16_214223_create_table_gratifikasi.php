<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGratifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gratifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('jenis');
            $table->string('bentuk');
            $table->unsignedInteger('nilai');
            $table->date('waktu');
            $table->string('nama');
            $table->string('hubungan');
            $table->text('alamat');
            $table->text('alasan');
            $table->string('unit');
            $table->string('jabatan');
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
        Schema::dropIfExists('gratifikasi');
    }
}
