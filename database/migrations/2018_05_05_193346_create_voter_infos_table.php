<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voter_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->json('address')->nullable();
            $table->integer('number_of_share')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();

            $table->foreign('username')
            ->references('username')
            ->on('users')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
