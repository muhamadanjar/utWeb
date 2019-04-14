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
            $table->increments('id');
            $table->string('username');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('md5_password');
            $table->text('api_token')->nullable();
            $table->boolean('isactived')->nullable()->default(0);
            $table->boolean('isverified')->default(0);
            $table->string('foto')->nullable();
            $table->timestamp('latestlogin')->nullable();
            $table->string('uuid')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('user_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('username')->unsigned();
            $table->string('token');
            $table->foreign('username')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_verifications");
        Schema::dropIfExists('users');
    }
}
