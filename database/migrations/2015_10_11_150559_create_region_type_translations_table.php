<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region_type_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('locale')->index();

            $table->unique(['region_type_id','locale']);
            $table->foreign('region_type_id')->references('id')->on('region_types')->onDelete('cascade');
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
        Schema::drop('region_type_translations');
    }
}
