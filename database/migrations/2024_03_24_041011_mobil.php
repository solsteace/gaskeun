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
        Schema::create("mobil", function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_admin");

            $table->string("brand", 32);
            $table->string("model", 64);
            $table->unsignedTinyInteger("kapasitas");
            $table->unsignedInteger("harga_sewa");
            $table->string("deskripsi", 1024);
            $table->string("image");
            $table->string("status", 16);
            $table->string("nomor_polisi", 16);
            $table->string("transmisi", 8);

            $table->foreign("id_admin")->references("id")->on("admin");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobil');
    }
};
