<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('region_type_id')->nullable()->default(1);
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('shortcut_id')->nullable();
            $table->boolean('is_structural');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('regions');
    }
}
