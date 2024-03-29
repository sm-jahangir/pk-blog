<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->default('default.png');
            $table->text('body');
            $table->integer('view_count');
            $table->boolean('status')->default(false);
            $table->boolean('is_approved')->default(false);
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); akhane rakhle kaj kore nah ai relation manully korchi ami
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
        Schema::dropIfExists('posts');
    }
}
