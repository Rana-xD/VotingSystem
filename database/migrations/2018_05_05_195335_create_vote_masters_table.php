<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('meeting_uuid')->nullable();
            $table->json('vote_setting')->nullable();
            $table->enum('voter_role', ['NOMINEE', 'SHARE_HOLDER'])->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('vote_masters');
    }
}
