<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('hp')->nullable();
            $table->string('nip')->unique();
            $table->string('password');
            $table->string('pangkat')->nullable();//pangkat
            $table->string('jabatan')->nullable();//jabatan
            $table->string('unit')->nullable();//unit kerja
            $table->string('tempat')->nullable();//unit kerja
            $table->unsignedTinyInteger('status_1')->nullable();//status_gratifikasi > 1 = Tidak, 2 = Iya+Lapor, 3 = Iya+Belum_lapor
            $table->unsignedTinyInteger('status_2')->nullable();//jumlah_gratifikasi > total gratifikasi, jika status_gratifikasi = 3
            $table->unsignedTinyInteger('status_3')->nullable();//jumlah_gratifikasi > total gratifikasi, jika status_gratifikasi = 3
            $table->unsignedTinyInteger('status_laporan')->nullable();//status_laporan > 0=belum selesai, 1=selesai
            $table->unsignedTinyInteger('finish')->nullable();//status_laporan > 0=belum selesai, 1=selesai
            $table->date('tanggal')->nullable();//status_laporan > 0=belum selesai, 1=selesai
            $table->enum('admin', ['0','1','2']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
