<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText('content');
            $table->string('forum');
            $table->string('author');
            $table->string('slug')->nullable();
            $table->tinyInteger('sticky')->default(0);
            $table->tinyInteger('locked')->default(0);
            $table->string('type')->default('default');
            $table->string('color')->default('rgb(0,240,120)');
            $table->integer('views')->default(0);
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
        Schema::dropIfExists('topics');
    }
}
