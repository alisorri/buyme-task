<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks;
        return  response()->json($tasks);
    }
    /*
     *
     */
    public function store(Request $request){
        dd ($request);
        $task = request()->validate(['name' => 'required|max:255']);

        dd($task);
    }

    /**\
     * @param Request $request
     * @param Task $task
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Task $task){
        $this->authorize('destroy', $task);

        $task->delete();
    }
}
