<?php

namespace App\Http\Controllers;

use App\Models\Section_room;
use App\Http\Requests\StoreSection_roomRequest;
use App\Http\Requests\UpdateSection_roomRequest;

class SectionRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section_room::query();
        $sections = $sections->paginate();
        return view('section-rooms.index', ['sections' => $sections]);
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
    public function store(StoreSection_roomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Section_room $section_room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section_room $section_room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSection_roomRequest $request, Section_room $section_room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section_room $section_room)
    {
        //
    }
}
