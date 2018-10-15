<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection;
use App\Http\Requests\CreateTaskRequest;
use Illuminate\Validation\ValidationException;
use App\Task;
use App\User;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('user', 'notes.user')->get();

        return new TaskCollection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 'hello';
        try {
            $request->validate([
                'name' => 'required',
                'status' => 'required',
                'contact_name' => 'required|min:3',
                'contact_phone' => 'required|min:11|numeric',
                'website' => 'required|url',
                'cost' => 'required|numeric'
            ]); 

            $userCreateTask = Auth::user()->tasks()->create([
                'name' => $request->name,
                'status' => $request->status,
                'contact_name' => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'website'   => $request->website,
                'cost' => $request->cost
            ]);
            
            if($request->addComment) {
                Auth::user()->notes()->create([
                    'notes' => $request->notes,
                    'task_id' => $userCreateTask->id
                ]);
            }
            return $userCreateTask;
        } catch(ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
                ], 422
            );        
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $tasks = Task::with('user', 'notes.user')->where('id',$id)->first();

        // return new TaskCollection($tasks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
