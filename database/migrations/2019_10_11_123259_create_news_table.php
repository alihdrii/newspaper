<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('introduce');
            $table->string('text');
            $table->string('thumbnail_path');
            $table->tinyInteger('status');
            $table->tinyInteger('news_kind')->default(0);
            $table->string('slug');
            $table->bigInteger('user_id');
            $table->bigInteger('cat_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('Users');
            $table->foreign('cat_id')->references('id')->on('cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
