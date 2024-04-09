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
        Schema::create("Pengguna", function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_image");

            $table->string("nama", 64);
            $table->string("email", 64)->unique();
            $table->string("password", 64);
            $table->enum("role", ["user", "admin"])->default("user");

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
        Schema::dropIfExists('Pengguna');
    }
};