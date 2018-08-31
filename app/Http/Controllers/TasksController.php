<?php

namespace App\Http\Controllers;

use App\Task;
use Auth;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome()
    {

        /*$isLoggedIn = Auth::check();

        if ($isLoggedIn == false) {
        return redirect('/login');
        }*/

        return view('welcome');

    }
    public function index()
    {
        // GET /tasks
        //$tasks = DB::table('tasks')->get();
        //$tasks = Task::all();

        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->latest()->get();

        return (compact('tasks', 'user') /*['tasks' => $tasks]*/);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3|max:128',
            'status' => 'required|in:ongoing,deleted,completed',
            'dueDate' => 'required',
        ]);
        $user_id = Auth::user()->id;

        $request->request->add(['responsible_id' => $user_id]);
        $request->request->add(['user_id' => $user_id]);
        
        Task::create($request->all());

        //Task::create(request(['name', 'responsible_id', 'dueDate', 'status']));

        $tasks = Task::all();

        // And then redirect to the tasks page
        return ['data' => $tasks];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tasks,id',
            'name' => 'required',
            'status' => 'required|in:ongoing,deleted,completed',
            'dueDate' => 'required',
        ]);

        /*$task = Task::findOrFail($request->id);
        $task = Task::where('id', $request->id)->first();

        $task->name = $request->name;
        $task->responsible = $request->responsiple;
        $task->dueDate = $request->dueDate;
        $task->save();*/

        $task = Task::findOrFail($request->id)->update($request->toArray());

        // PATCH/ tasks/id
        //Task::patch(request(['name', 'responsible', 'dueDate', 'status'])->where('id', $id));

        // $task = Task::only(['name', 'responsible', 'dueDate', 'status']);

        // And then redirect to the tasks page
        return ['data' => $task];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // DELETE /tasks/id
        $task = Task::findOrFail($id)->delete();
        return ['data' => $task];
    }
}
