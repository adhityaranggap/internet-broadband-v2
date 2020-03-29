<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->date('tgl_bayar');
            $table->date('tgl_jatuh_tempo');
            $table->enum('jenis_pembayaran', ['tunai', 'non-tunai']);
            $table->string('file');
            $table->enum('status', ['tertunda', 'dibayar', 'kedaluwarsa', 'belum dibayar']);
            $table->text('notes');

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('modified_by');
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
        Schema::dropIfExists('payments');
    }
}
