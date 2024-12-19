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


    public function assignUser(Request $request, Task $task)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Dodaj korisnika na task (pretpostavljamo da postoji many-to-many relacija)
        $task->users()->syncWithoutDetaching([$request->user_id]);

        return redirect()->back()->with('success', 'Korisnik uspješno dodijeljen tasku.');
    }

    public function removeUser(Task $task, User $user)
    {
        // Ukloni korisnika s taska (pretpostavlja many-to-many relaciju)
        $task->users()->detach($user->id);

        return redirect()->back()->with('success', 'Korisnik uspješno uklonjen s taska.');
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
