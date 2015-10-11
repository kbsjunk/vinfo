<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBottleCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bottle_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('vintage_id');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('rack_id')->nullable();
            $table->unsignedInteger('shelf_id')->nullable();
            $table->unsignedInteger('bottle_size_id')->default(1);
            $table->unsignedInteger('vendor_id')->nullable();
            $table->date('purchased_at')->nullable();
            $table->unsignedInteger('consumed_reason_id')->nullable();
            $table->date('consumed_at')->nullable();
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
        Schema::drop('bottle_cases');
    }
}
