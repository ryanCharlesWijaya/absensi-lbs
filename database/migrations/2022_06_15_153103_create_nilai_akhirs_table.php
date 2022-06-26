<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiAkhirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_akhirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("guru_id");
            $table->foreignId("siswa_id");
            $table->foreignId("semester_id");
            $table->integer("nilai_ulangan");
            $table->integer("nilai_praktek");
            $table->integer("nilai_tugas");
            $table->integer("nilai_akhir");
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
        Schema::dropIfExists('nilai_akhirs');
    }
}
