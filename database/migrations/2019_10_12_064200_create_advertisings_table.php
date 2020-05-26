<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('ad_type');
            $table->string('banner_path');
            $table->string('url');
            $table->string('description')->nullable();
            $table->integer('count')->default(0);
            $table->bigInteger('ad_client_id');
            $table->date('started_at')->nullable();
            $table->integer('period');
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('ad_client_id')->references('id')->on('ad_clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisings');
    }
}
