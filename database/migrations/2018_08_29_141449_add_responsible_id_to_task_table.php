<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Task;
use App\User;

class AddResponsibleIdToTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('responsible_id')->nullable()->unsigned();
            $table->foreign('responsible_id')->references('id')->on('users');
        });

        // move over the data from responsible to ids

        $tasks = Task::all();

        foreach ($tasks as $task) {

            $responisble = User::where('name', $task->responsible)->first();

            if (is_null($responsible) == false) {

                $task->responsible_id = $responsible->id;
                $task->save();
            }

        }

        // get all tasks from data base
        // find the users in the user table via the responsible string - and then get the Id
        // then update the task entry's with the responsible id - if possible

        // then we would drop the old responsible from the table
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('responsible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {

            $table->string('responsible')->nullable();

        });

        // use the responsible id to find the name of the responsible in the user data base
        // update the responsible string value using that id
        // save the entry

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_responsible_id_foreign');
            $table->dropColumn('responsible_id');
        });
    }
}
