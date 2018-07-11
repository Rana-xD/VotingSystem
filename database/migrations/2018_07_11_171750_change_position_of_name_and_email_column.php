<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePositionOfNameAndEmailColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voter_infos', function (Blueprint $table) {
            $table->string("name",150)->nullable()->after("username");
            $table->string("email",150)->nullable()->after("name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voter_infos', function (Blueprint $table) {
            $table->dropColumn("name");
            $table->dropColumn("email");
        });
    }
}
