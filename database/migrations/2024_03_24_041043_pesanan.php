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
        Schema::create("pesanan", function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_pemesan");
            $table->unsignedBigInteger("id_mobil");
            $table->string("KTP_peminjam");
            $table->string("SIM_peminjam");
            $table->string("nama_peminjam"); // Order could be made for other people
            $table->date("tanggal_peminjaman");
            $table->date("tanggal_pengembalian");

            $table->foreign("id_pemesan")->references("id")->on("pengguna");
            $table->foreign("id_mobil")->references("id")->on("mobil");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
};
