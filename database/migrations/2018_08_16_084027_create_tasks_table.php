<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tasks', function (Blueprint $table) {   

            $table->increments('id');
            $table->text('name');
            $table->date('dueDate');
            $table->text('status');
            $table->timestamps();

            $table->string('responsible');
            
            $table->integer('user_id')->unsigned();

           
            $table->foreign('user_id')->references('id')->on('users');

            $table->index('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
