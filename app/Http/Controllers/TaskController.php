<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['activityType', 'taskStatus', 'companyProfile', 'users'])->get();
        $users = User::all(); // Dohvati sve korisnike

        return view('tasks.index', [
            'tasks' => $tasks,
            'users' => $users, // Dodaj sve korisnike u view
        ]);
    }

    public function assignUsers(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        // Validacija zahtjeva - da korisnici dolaze kao array
        $request->validate([
            'user_ids' => 'nullable|array',
        'user_ids.*' => 'exists:users,id',
        ]);

        // Dodaj korisnike na task (sync će obrisati stare i dodati nove)
        $task->users()->sync($request->input('user_ids', []));

        return redirect()->route('tasks.index')->with('success', 'Korisnici su uspješno ažurirani.');
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
    public function store(StoreTaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
