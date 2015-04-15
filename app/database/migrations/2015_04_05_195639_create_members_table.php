<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('nickname')->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->date('birthday')->nullable();
            $table->string('usauID')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->boolean('receive_texts')->nullable();
            $table->string('photo_path')->nullable();
            $table->enum('series_intention', array('yes','no','maybe'))->nullable();
            $table->longText('personal_strengths')->nullable();
            $table->longText('personal_weaknesses')->nullable();
            $table->longText('areas_to_improve')->nullable();
            $table->longText('playing_history')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('members');
    }

}
