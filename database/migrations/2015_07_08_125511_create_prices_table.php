<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('price');
            $table->unsignedInteger('price_local');
            $table->unsignedInteger('price_type_id');
            $table->unsignedInteger('priceable_id');
            $table->string('priceable_type');
            $table->string('currency_code', 3)->default('USD');;
            $table->dateTime('priced_at')->nullable();
            $table->dateTime('converted_at')->nullable();
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
        Schema::drop('prices');
    }
}
