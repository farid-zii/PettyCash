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
            $table->foreignId('realisasi_id')->nullable();
            $table->string('bank');
            $table->text('keterangan');
            $table->text('project');
            $table->string('norek');
            $table->double('pengajuan',12)->nullable();
            $table->double('debit',12)->nullable();
            $table->string('approveF')->nullable();
            $table->text('komenF')->nullable();
            $table->double('refund',12)->nullable();
            $table->double('total',10)->nullable();
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
