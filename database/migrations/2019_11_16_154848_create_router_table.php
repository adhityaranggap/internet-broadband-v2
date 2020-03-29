<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('router', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SN_router')->unique();
            $table->string('merk_router');
            $table->string('tipe_router');
            $table->string('mac_address');
            $table->unsignedInteger('customer_id');
            $table->rememberToken(); //remember me 
            $table->timestamps(); //generate created_at and update_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('router');
    }
}
