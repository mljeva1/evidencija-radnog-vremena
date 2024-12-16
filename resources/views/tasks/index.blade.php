@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="text-center">Popis aktualnih taskova</h2>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Šifra taska</th>
                <th>Ime taska</th>
                <th>Opis taska</th>
                <th>Radno vrijeme rješavanja</th>
                <th>Kompanija</th>
                <th>Vrsta aktivnosti</th>
                <th>Task status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
            <tr>
                <th>{{ $task->id }}</th>
                <th>{{ $task->task_code }}</th>
                <th>{{ $task->task_name }}</th>
                <th>{{ $task->task_description }}</th>
                <th>{{ $task->work_time ? ($task->work_time)+'h' : 'N/A' }}</th>
                <th>{{ $task->companyProfile->company_name }}</th>
                <th>{{ $task->activityType->name }} - {{ $task->activityType->description ? $task->activityType->description : 'N/A'}}</th>
                <th>{{ $task->taskStatus->name }}</th>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Nema dostupnih kompanija.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection