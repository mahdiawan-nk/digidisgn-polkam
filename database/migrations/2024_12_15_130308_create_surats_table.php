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
        Schema::create('surats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->string('perihal');
            $table->string('deskripsi')->default(null);
            $table->enum('status_pengajuan', ['in prosess', 'in verification', 'in validation','returned','finished','re-submited'])->default('in prosess');
            $table->unsignedBigInteger('pengirim_id');
            $table->string('validation_rule')->default(null);
            $table->string('qr_code_path')->default(null);
            $table->string('file_surat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};