<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->char('npm', 10)->primary();
            $table->char('nidn', 10)->nullable();
            $table->string('nama', 50);
            $table->string('kelas', 10)->nullable();
            $table->year('angkatan')->nullable();
            $table->timestamps();

            $table->foreign('nidn')->references('nidn')->on('dosen')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
