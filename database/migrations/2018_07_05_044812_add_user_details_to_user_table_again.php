<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserDetailsToUserTableAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table){
            $table->integer('access')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('cover_image')->nullable();
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
        Schema::table('users', function($table){
            $table->dropColumn('access');
            $table->dropColumn('age');
            $table->dropColumn('gender');
            $table->dropColumn('cover_image');
        });

    }
}
