<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('regions', function(Blueprint $table) {

      $table->increments('id');
      // $table->string('name')->index();
      // $table->text('description')->nullable();
      
      $table->integer('parent_id')->nullable()->index();
      $table->integer('lft')->nullable()->index();
      $table->integer('rgt')->nullable()->index();
      $table->integer('depth')->nullable();

      $table->unsignedInteger('country_id')->nullable();
      $table->unsignedInteger('shortcut_id')->nullable();
      $table->unsignedInteger('region_type_id')->nullable();
      $table->boolean('is_structural');

      $table->timestamps();
      $table->softDeletes();

      $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
      $table->foreign('shortcut_id')->references('id')->on('regions')->onDelete('cascade');
      $table->foreign('region_type_id')->references('id')->on('region_types')->onDelete('cascade');
      
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('regions');
  }

}
