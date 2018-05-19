<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vote_master_id');
            $table->string('username')->nullable();
            $table->boolean('isAppointed')->nullable();
            $table->string('proxy')->nullable();
            $table->json('vote')->nullable();
            $table->timestamps();

            $table->foreign('vote_master_id')
            ->references('id')
            ->on('vote_masters')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

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
        Schema::dropIfExists('votes');
    }
}
