<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationToRestaurantAgain extends Migration
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
            $table->float('latitude');
            $table->float('longitude');
            $table->string('address');
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
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('address');
        });

    }

}
