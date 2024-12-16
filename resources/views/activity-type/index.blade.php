@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="text-center">Popis aktivnosti zaposlenika</h2>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Aktivnost</th>
                <th>Opis</th>
                <th>Datum stvaranja</th>
                <th>Datum ažuriranja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($activity as $active)
            <tr>
                <td>{{ $active->id }}</td>
                <td>{{ $active->name }}</td>
                <td>{{ $active->description ? $active->description : 'N/A' }}</td>
                <td>{{ $active->created_at }}</td>
                <td>{{ $active->updated_at }}</td>
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