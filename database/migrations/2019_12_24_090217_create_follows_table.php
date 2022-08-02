<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id')->autoIncrement(); //自動で 上に入ってくる
            $table->integer('follow');
            $table->integer('follower');
            $table->timestamp('created_at')->useCurrent();
        });
    }
    // create table follows(
    // id int(11) primary key auto_increment,
    // follow int(11),
    // follower int(11),
    // created_at timestamp not null default current_timestamp,
    // )

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
