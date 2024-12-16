<?php

namespace App\Http\Controllers;

use App\Models\Task_status;
use App\Http\Requests\StoreTask_statusRequest;
use App\Http\Requests\UpdateTask_statusRequest;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task_status = Task_status::query();
        $task_status = $task_status->paginate();
        return view('task-status.index', ['task_status' => $task_status]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTask_statusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task_status $task_status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task_status $task_status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTask_statusRequest $request, Task_status $task_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task_status $task_status)
    {
        //
    }
}
