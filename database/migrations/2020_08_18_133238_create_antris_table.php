<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antris', function (Blueprint $table) {
            $table->id();
            $table->string('no_antri');
            $table->date('tanggal')->nullable();
            $table->unsignedBigInteger('id_pengunjung');
            $table->foreign('id_pengunjung')->references('id')->on('pengunjungs')->onDelete('cascade');
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
        Schema::dropIfExists('antris');
    }
}
