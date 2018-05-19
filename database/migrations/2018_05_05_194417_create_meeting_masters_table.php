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
        Schema::create('meeting_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meeting_uuid')->unique();
            $table->string('title')->nullable();
            $table->string('logo')->nullable();
            $table->dateTime('date_of_meeting')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('expired_date')->nullable();
            $table->json('document')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('isExpired')->default(false);
            $table->timestamps();

            $table->index('meeting_uuid');
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
