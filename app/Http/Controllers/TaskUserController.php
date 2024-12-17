<?php

namespace App\Http\Controllers;

use App\Models\Task_user;
use App\Http\Requests\StoreTask_userRequest;
use App\Http\Requests\UpdateTask_userRequest;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskUserController extends Controller
{
    // Dodaj korisnika u task
    public function addUserToTask($taskId, $userId)
    {
        $task = Task::findOrFail($taskId);
        $task->users()->attach($userId); // Dodavanje korisnika u task

        return back()->with('success', 'Korisnik je uspješno dodan u task.');
    }

    // Dodaj task korisniku
    public function addTaskToUser($userId, $taskId)
    {
        $user = User::findOrFail($userId);
        $user->tasks()->attach($taskId); // Dodavanje taska korisniku

        return back()->with('success', 'Task je uspješno dodan korisniku.');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTask_userRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task_user $task_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task_user $task_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTask_userRequest $request, Task_user $task_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task_user $task_user)
    {
        //
    }
}
