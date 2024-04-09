<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("Mobil", function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_pengguna");

            $table->string("brand", 32);
            $table->string("model", 64);
            $table->unsignedTinyInteger("kapasitas");
            $table->unsignedInteger("harga_sewa");
            $table->string("deskripsi", 1024);
            $table->string("image");
            $table->enum("status", ["tersedia", "dipinjam", "tidak_tersedia"])->default("tersedia");
            $table->string("nomor_polisi", 16);
            $table->enum("transmisi", ["manual", "matic", "lainnya"])->default("manual");

            $table->foreign("id_pengguna")->references("id")->on("Pengguna");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Mobil');
    }
};