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
        Schema::create('kuisioner_alumni_hasil', function (Blueprint $table) {
            $table->id();
            $table->string('npm');
            $table->string('nama_mahasiswa');
            $table->string('pertanyaan');
            $table->string('jawaban');
            $table->integer('point');
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
        Schema::dropIfExists('kuisioner_alumni_hasil');
    }
};
