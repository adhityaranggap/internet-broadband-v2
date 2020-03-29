<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {

                $table->bigIncrements('id');
                $table->unsignedInteger('customer_has_package_id');
                $table->string('subject');
                $table->text('description');
                $table->integer('priority');
                $table->text('attachment');
                $table->tinyInteger('status');
                $table->string('ticket_number')->unique();
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
        Schema::dropIfExists('tickets');
    }
}
