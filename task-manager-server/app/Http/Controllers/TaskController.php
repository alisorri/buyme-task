<?php

namespace App\Http\Controllers;

use App\Task;
use http\Env\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Validation\Validator;
use mysql_xdevapi\Exception;

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
        return view('tasks.index',compact('tasks'));
    }

    /**
     * Add task
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $validator = Validator($request->all(),['name' => 'required|max:255']);
        if($validator->fails()){
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()]);
        }
        try{
            $task = new Task();
            $task->name=$request->name;
            $task->user_id=$request->user()->id;
            $task->save();
        }catch (Exception $exception){
            return response()->json(["status"=>false,"message"=>"Add task failed"]);
        }
        return response()->json(["status"=>true,"message"=>"Task added successfully"]);
    }

    /**\
     * Delete task
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Task $task){
        try{
          //  $this->authorize('destroy',$request->user(), $task);
        }
        catch (AuthenticationException $exp){
            return response()->json(['status'=>false,'message'=>'User not authorized']);
        }
        try{
            $task->delete();
        }catch (Exception $exception){
            return response()->json(['status'=>false,'message'=>'Task delete failed']);
        }

        return response()->json(['status'=>true, 'message'=>'Task deleted successfully']);
    }

    /**
     * Edit Task
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,Task $task){
        $validator = Validator($request->all(),['name' => 'required|max:255']);
        if($validator->fails()){
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()]);
        }
        try{
            //  $this->authorize('destroy',$request->user(), $task);
        }
        catch (AuthenticationException $exp){
            return response()->json(['status'=>false,'message'=>'User not authorized']);
        }
        try{
            $task->update(["name"=>$request->name]);
        }catch (Exception $exception){
            return response()->json(["status"=>false,"message"=>"Update task failed"]);
        }
        return response()->json(["status"=>true,"message"=>"Task updated successfully"]);
    }
}
