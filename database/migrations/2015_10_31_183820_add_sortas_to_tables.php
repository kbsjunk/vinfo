<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSortasToTables extends Migration
{
    protected $tables = [
        'bottle_size_translations',
        'consumed_reason_translations',
        'currency_translations',
        'country_translations',
        'region_translations',
        'region_type_translations'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $item) {
            Schema::table($item, function (Blueprint $table) {
                $table->binary('sortas')->after('name')->collate('binary');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $item) {
            Schema::table($item, function (Blueprint $table) {
                $table->dropColumn('sortas');
            });
        }
    }
}
