@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center">Registracija</h3>
    <form method="POST" action="{{ route('auth.register') }}">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">Ime</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Prezime</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Lozinka</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Ponovite lozinku</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label">Uloga</label>
            <option disabled>User</option>
        </div>
        <div class="mb-3">
            <label for="section_id" class="form-label">Sekcija/Soba</label>
            <select name="section_id" id="section_id" class="form-select" required>
                <option value="">Odaberite sekciju</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->naziv }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registracija</button>
    </form>
</div>
@endsection
