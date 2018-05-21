<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('meeting_uuid');
            $table->string('pin');
            $table->timestamps();

            
            $table->foreign('username')
            ->references('username')
            ->on('users')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

            
            $table->foreign('meeting_uuid')
            ->references('meeting_uuid')
            ->on('meeting_masters')
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
        Schema::dropIfExists('meeting_users');
    }
}
