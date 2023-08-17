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
            $table->foreignId('user_id');
            $table->foreignId('bank_id');
            $table->string('norek');
            $table->double('nominal',12);
            $table->text('keterangan');
            $table->text('bukti')->nullable();
            $table->string('approve')->nullable();
            $table->text('komen')->nullable();
            $table->double('nominalAcc',12)->nullable();
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
