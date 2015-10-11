<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBottleSizeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bottle_size_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bottle_size_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['bottle_size_id','locale']);
            $table->foreign('bottle_size_id')->references('id')->on('bottle_sizes')->onDelete('cascade');
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
        Schema::drop('bottle_size_translations');
    }
}
