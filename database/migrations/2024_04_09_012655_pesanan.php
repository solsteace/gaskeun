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
        Schema::create("Pesanan", function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_pemesan");
            $table->unsignedBigInteger("id_mobil");
            $table->unsignedBigInteger("id_pembayaran");

            $table->string("SIM_peminjam");
            $table->string("nama_peminjam"); // Order could be made for other people
            $table->date("tanggal_peminjaman");
            $table->date("tanggal_pengembalian");
            $table->string("titik_antar")->nullable();
            $table->string("titik_jemput")->nullable();
            $table->enum("status", ["selesai", "belum_selesai"])->default("belum_selesai");

            $table->foreign("id_pemesan")->references("id")->on("Pengguna");
            $table->foreign("id_pembayaran")->references("id")->on("Pembayaran");
            $table->foreign("id_mobil")->references("id")->on("Mobil");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pesanan');
    }
};
