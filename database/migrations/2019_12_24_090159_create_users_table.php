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
            $table->increments('id')->autoIncrement();
            $table->string('username',255);
            $table->string('mail',255);
            $table->string('password',255);
            $table->string('bio',400)->nullable(); //nullable空欄でも可能
            $table->string('images',255)->default('dawn.png')->nullable(); //default デフォルト値
            $table->timestamps();
        });
    }
    //create table users(
    // id int(11) primary key auto_increment,
    // username varchar(255),
    // mail varchar(255) not null,
    // password varchar(255) not null,
    // bio varchar(400),
    // images varchar(255)
    // );

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
