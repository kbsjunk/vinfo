<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumedReasonsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumed_reason_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consumed_reason_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['consumed_reason_id','locale']);
            $table->foreign('consumed_reason_id')->references('id')->on('consumed_reasons')->onDelete('cascade');
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
        Schema::drop('consumed_reason_translations');
    }
}
