<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatLngToRestaurantsOnceMore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('restaurants', function($table){
            $table->float('lat', 30, 30)->change();
            $table->float('lng', 30, 30)->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('restaurants', function($table){
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });

    }
}
