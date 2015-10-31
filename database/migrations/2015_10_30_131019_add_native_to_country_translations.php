<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNativeToCountryTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('country_translations', function (Blueprint $table) {
            $table->boolean('is_native');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('country_translations', function (Blueprint $table) {
            $table->dropColumn('is_native');
        });
    }
}
