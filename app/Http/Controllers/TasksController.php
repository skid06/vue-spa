<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection;
use App\Http\Requests\CreateTaskRequest;
use App\Task;
use App\Customer;
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
        $tasks = Task::with('customer', 'notes.customer')->paginate(10);

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
        $userCreateTask = Auth::user()->tasks()->create([
            'name' => $request->name,
            'status' => $request->status,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'website'   => $request->website,
            'cost' => $request->cost
        ]);
        return $userCreateTask;
        // return Task::create([
        //     'name' => $request->name,
        //     'status' => $request->status,
        //     'contact_name' => $request->contact_name,
        //     'contact_phone' => $request->contact_phone,
        //     'website'   => $request->website,
        //     'cost' => $request->cost
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $tasks = Task::with('customer', 'notes.customer')->where('id',$id)->first();

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
