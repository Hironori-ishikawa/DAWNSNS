<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->integer('user_id');
            $table->string('posts',500);
            $table->timestamps();
        });
    }
    //create table posts(
    //  id int(11) primary key auto_increment,
    //  user_id int(11),
    //  posts varchar(500) not null,
    //  created_at timestamp not null default current_timestamp,
    //  updated_at timestamp not null default current_timestamp on update current_timestamp
    //);

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
