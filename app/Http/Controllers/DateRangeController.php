<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController as ResponseController;
use App\Task;
use App\User;

class DateRangeController extends ResponseController
{
    //

    public function index (Request $request)
    {

        $tasks = Task::whereBetween('created_at', [$request->get('from'),     
        $request->get('to')])->get();

        //return view('tasks.index')->with('tasks', $tasks);
        

        return $this->sendResponse($tasks->toArray(), 'Task Retrieved successfully');
    }   
}
