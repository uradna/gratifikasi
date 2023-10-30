<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('createusers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('nip');
            $table->string('email')->nullable();
            $table->string('hp')->nullable();
            $table->string('unit')->nullable();//unit kerja sekarang
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
        Schema::dropIfExists('createusers');
    }
}
