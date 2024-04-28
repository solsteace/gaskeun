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
            $table->unsignedBigInteger("id_image");

            $table->string("brand", 32);
            $table->string("model", 64);
            $table->unsignedTinyInteger("kapasitas");
            $table->unsignedInteger("harga_sewa");
            $table->string("deskripsi", 1024);
            $table->enum("status", ["tersedia", "dipinjam", "tidak_tersedia"])->default("tersedia");
            $table->string("nomor_polisi", 16);
            $table->enum("transmisi", ["manual", "matic", "lainnya"])->default("manual");
            $table->enum("bahan_bakar", ["bensin", "listrik", "diesel"])->default("bensin");

            $table->foreign("id_pengguna")->references("id")->on("Pengguna");
            $table->foreign("id_image")->references("id")->on("Images");
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