@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="text-center">Popis kompanija</h2>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ime kompanije</th>
                <th>Opis kompanije</th>
                <th>Početak partnerstva</th>
                <th>Datum ažuriranja</th>
                <th>Status partnerstva</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->company_name }}</td>
                <td>{{ $company->description ? $company->description : 'N/A' }}</td>
                <td>{{ $company->partnership_start_at }}</td>
                <td>{{ $company->partnership_updated_at ?? 'N/A' }}</td>
                <td>{{ $company->partnership_ended == 1 ? 'U tijeku' : 'Završeno' }}</td>
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