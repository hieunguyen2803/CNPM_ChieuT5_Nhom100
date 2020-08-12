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
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('gender')->nullable()->default(null);
            $table->string('key')->nullable()->default(null);
            $table->string('isactive')->nullable()->default('0');
//            $table->string('name')->nullable()->default(null);
            $table->string('google_id')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->string('avatar_origin')->nullable()->default(null);
            $table->string('remember_token')->nullable()->default(null);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);

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
