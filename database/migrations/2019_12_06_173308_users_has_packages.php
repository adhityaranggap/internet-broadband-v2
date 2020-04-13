<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersHasPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_has_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('package_id');
            $table->enum('verification', ['First Month', 'Date Payment'])->default('First Month');
            $table->enum('status', ['active','inactive']);            
            $table->text('notes');     
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
        Schema::dropIfExists('users_has_packages');
    }
}
