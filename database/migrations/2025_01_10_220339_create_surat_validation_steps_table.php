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
        Schema::create('surat_validation_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('surat_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('step_order');
            $table->enum('role_required', ['verifikator-kabag', 'verifikator-wd', 'validator-kabag', 'validator-wd','validator-direktur']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surats')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_validation_steps');
    }
};
