<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('contact_person');
            $table->text('password');
            $table->string('alamat');
            $table->unsignedInteger('router_id');
            $table->unsignedInteger('akses_group_id')->default(0);
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
        Schema::dropIfExists('users');
    }
}
