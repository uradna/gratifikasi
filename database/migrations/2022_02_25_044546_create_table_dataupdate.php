<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDataupdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataupdate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('nip')->nullable();
            $table->string('unit_1')->nullable();//unit kerja sekarang
            $table->string('unit_2')->nullable();//unit kerja sebelumnya
            $table->text('keterangan')->nullable();//unit kerja sebelumnya
            $table->string('file')->nullable();//file
            $table->enum('status', ['0','1','2']);
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
        Schema::dropIfExists('dataupdate');
    }
}
