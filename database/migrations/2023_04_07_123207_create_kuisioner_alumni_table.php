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
        Schema::create('kuisioner_alumni', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'alumni', 'mahasiswa'])->default('alumni');
            $table->integer('npm')->unique();
            $table->string('nama_mahasiswa');
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
        Schema::dropIfExists('kuisioner_alumni');
    }
};
