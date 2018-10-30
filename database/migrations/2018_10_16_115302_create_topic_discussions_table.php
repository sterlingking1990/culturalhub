<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_discussions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id');
            $table->integer('user_id');
            $table->string('topic_body');
            $table->string('discussion_image');
            $table->text('tribes');
            $table->integer('likes')->default(1);
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
        Schema::dropIfExists('topic_discussions');
    }
}
