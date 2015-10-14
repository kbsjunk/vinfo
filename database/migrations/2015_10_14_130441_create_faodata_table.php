<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_faostat', function (Blueprint $table) {
            $table->increments('id');
			$table->string('country', 4);
			$table->unsignedInteger('year');
			$table->unsignedInteger('tonnes');
			$table->string('status', 1);
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
        Schema::drop('data_faostat');
    }
}
