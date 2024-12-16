<?php

namespace App\Http\Controllers;

use App\Models\Activity_type;
use App\Http\Requests\StoreActivity_typeRequest;
use App\Http\Requests\UpdateActivity_typeRequest;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activity = Activity_type::query();
        $activity = $activity->paginate();
        return view('activity-type.index', ['activity' => $activity]);
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
    public function store(StoreActivity_typeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity_type $activity_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity_type $activity_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivity_typeRequest $request, Activity_type $activity_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity_type $activity_type)
    {
        //
    }
}
