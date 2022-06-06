<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("tugas_id");
            $table->foreignId("siswa_id");
            $table->integer("nilai")->nullable();
            $table->timestamp("tanggal_pengumpulan")->nullable();
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
        Schema::dropIfExists('jawaban_tugas');
    }
}
