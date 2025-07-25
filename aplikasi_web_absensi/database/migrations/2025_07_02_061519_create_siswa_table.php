<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
             $table->string('nama');
             $table->string('jenis_kelamin');
             $table->string('asal_kampus');
             $table->string('jurusan');
             $table->string('semester');
             $table->string('alamat');
             $table->string('nohp');
             $table->string('nohp_orangtua');
             $table->string('foto')->nullable();
             $table->string('keterangan');
             $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
