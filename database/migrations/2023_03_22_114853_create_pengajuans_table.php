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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('kode',10)->nullable();
            $table->foreignId('pegawai_id');
            $table->string('bank');
            $table->text('keterangan');
            $table->string('norek');
            $table->string('type');
            $table->double('nominal',12);
            $table->string('approveF')->nullable();
            $table->text('komenF')->nullable();
            $table->string('approveD')->nullable();
            $table->text('komenD')->nullable();
            $table->double('refund',12)->nullable();
            $table->double('saldo',10)->nullable();
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
        Schema::dropIfExists('pengajuans');
    }
};
