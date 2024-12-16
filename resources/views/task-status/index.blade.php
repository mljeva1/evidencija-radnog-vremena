@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="text-center">Popis raspoloživih statusa</h2>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Naziv odjela</th>
                <th>Datum stvaranja</th>
                <th>Datum ažuriranja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($task_status as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at }}</td>
                <td>{{ $status->updated_at }}</td>
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