<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('users_has_packages_id');
            $table->text('notes');
            $table->unsignedInteger('transaction_has_modified_id');
            $table->dateTime('expired_date');
            $table->tinyInteger('status');
            $table->integer('price');
            $table->integer('paid')->nullable();
            $table->string('file')->nullable();
            $table->string('type_payment')->nullable();
            $table->integer('fee');
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
        Schema::dropIfExists('transactions');
    }
}
