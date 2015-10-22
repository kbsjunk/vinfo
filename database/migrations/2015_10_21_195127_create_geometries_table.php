<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeometriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geometries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quality')->default(1);
            $table->string('shape')->default('point');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('source')->nullable();
            $table->string('format')->nullable();
            $table->text('properties')->nullable();
            $table->unsignedInteger('geometried_id')->nullable();
			$table->string('geometried_type')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->engine = 'MyISAM';
        });

        DB::statement('ALTER TABLE `geometries`
        ADD COLUMN `geometry` GEOMETRY NOT NULL AFTER `id`,
        ADD SPATIAL INDEX `geometry` (`geometry`)
        ');
		
		// ADD COLUMN `centroid` POINT NOT NULL AFTER `geometry`
		// ADD SPATIAL INDEX `centroid` (`centroid`)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('geometries');
    }
}
