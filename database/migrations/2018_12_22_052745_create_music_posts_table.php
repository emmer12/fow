<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title");
            $table->mediumText("discription");
            $table->mediumText("lyric");
            $table->string("preview_image");
            $table->string("music");
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
        Schema::dropIfExists('music_posts');
    }
}
