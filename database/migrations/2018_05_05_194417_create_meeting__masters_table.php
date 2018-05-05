<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting__masters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_id')->unique();
            $table->string('title')->nullable();
            $table->string('logo')->nullable();
            $table->dateTime('date_of_meeting')->nullable();
            $table->string('location')->nullable();
            $table->time('time')->nullable();
            $table->date('expired_date')->nullable();
            $table->json('document')->nullable();
            $table->text('content')->nullable();
            $table->boolean('isExpired')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting__masters');
    }
}
