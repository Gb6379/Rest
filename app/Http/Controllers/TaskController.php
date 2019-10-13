<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Http\Controllers\ResponseController as ResponseController;
use Illuminate\Http\Request;


class TaskController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::all();
           

        return $this->sendResponse($tasks->toArray(), 'Task Retrieved successfully');

        //view
        //return view('tasks.index')->with('tasks', $tasks);
    }

   
 
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        return view('tasks.create')->with('users', $users);
       
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
         $this->validate($request, [
            "title" => "required|string|max:255",
            "description" => "required",
            "user_id"=> "required", 
            "due_at" => "required|unique:tasks,due_at,user_id" .\Auth::id(),
        ]);

        
        
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_at = $request->input('due_at');      
        $task->user_id = $request->input('user_id');

        $task->save();

        return $this->sendResponse($task->toArray(), 'Task created successfully.');

        //view
        //return redirect()->route('task')->with('success', 'New taks created');
                      
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */

    public function show($task_id)
    {
        //

        $task = Task::find($task_id);

        if (is_null($task)) {
            return $this->sendError('Task not found.');
        }

        return $this->sendResponse($task->toArray(), 'Task retrieved successfully.');

    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($task_id)
    {
        //
        $task = Task::find($task_id);
        $users = User::all();
        return view('tasks.edit')->with('task', $task)->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $task_id)
    {
        //
      // $input = $request->all();

       $this->validate($request, [
            "title" => "required|string|max:255",
            "description" => "required",
            "due_at"=> "required|unique:tasks,due_at,user_id" .\Auth::id(),
            "user_id" => "required"
        ]);

       
        
            $task = Task::find($task_id);

            if (is_null($task)) {
                return $this->sendError('Task not found.');
            }
           

            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->due_at = $request->input('due_at');
            $task->user_id = $request->input('user_id');

            $task->save();

            return $this->sendResponse($task->toArray(), 'Task updated successfully.');      

        //return redirect()->route('task')->with('success', 'Task Updated!');
    }

    public function completeTask(Task $task, $task_id)
    {

        //
        //$this->authorize('complete', $task);
        $task = Task::find($task_id);
        
        $task->is_completed = true;
        $task->save();

            
        //return redirect()->route('task')->with('success', 'Task completed');
        return $this->sendResponse($task->toArray(), 'Task completed successfully.');
    }

    public function uncompleteTask(Task $task, $task_id)
    {
        //
        $task = Task::find($task_id);
        
        $task->is_completed = false;
        $task->save();
       
        //return redirect()->route('task')->with('success', 'Task marked as uncompleted');

        return $this->sendResponse($task->toArray(), 'Task uncompleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($task_id)
    {
        //
        $task = Task::find($task_id);
        $task->delete();

        return $this->sendResponse($task->toArray(), 'Task deleted successfully.');
        //return redirect()->route('task')->with('danger', 'taks deleted');
        

    }
}
