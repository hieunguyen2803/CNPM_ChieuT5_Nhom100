<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->default(null);
            $table->string('last_name')->default(null);
            $table->string('email')->default(null);
            $table->string('password')->default(null);
            $table->string('phone')->default(null);
            $table->string('gender')->default(null);
            $table->string('key')->default(null);
            $table->string('isactive')->default('0');
            $table->string('name')->default(null);
            $table->string('google_id')->default(null);
            $table->string('avatar')->default(null);
            $table->string('avatar_origin')->default(null);
            $table->string('remember_token')->default(null);

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
