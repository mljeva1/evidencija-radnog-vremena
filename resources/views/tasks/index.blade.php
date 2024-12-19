@extends('layouts.app')

@section('content')

<div class="container-fluid mt-4">
    <h2 class="text-center">Popis svih taskova</h2>
    <table class="table table-striped table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <td scope="col">Šifra taska</td>
                <td scope="col">Ime taska</td>
                <td scope="col">Vrijeme rješavanja</td>
                <td scope="col">Vrsta aktivnosti</td>
                <td scope="col">Task status</td>
                <td scope="col">Dodijeljeni Korisnici</td>
                <td scope="col">Akcije</td>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
            <tr>
                <td>{{ $task->task_code }}</td>
                <td>{{ $task->task_name }}</td>
                <td>
                    @if ($task->work_time)
                        @if ($task->taskStatus->id == 1)
                            0 h
                        @else
                            {{ $task->work_time }}h
                        @endif
                    @else
                        N/A
                    @endif  
                </td>
                <td>{{ $task->activityType->name }} - {{ $task->activityType->description ? $task->activityType->description : 'N/A'}}</td>
                <td>{{ $task->taskStatus->name }}</td>
                <td>
                    @if ($task->users->count())
                        <ul>
                            @foreach ($task->users as $user)
                                <li>{{ $user->first_name }} {{ $user->last_name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <em>Nema dodijeljenih korisnika</em>
                    @endif
                </td>
                <td class="" style="height:100% !important;">
                    <!-- Gumb za edit -->
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">&#9986</a>
                    
                    <!-- Gumb za delete -->
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Jeste li sigurni?')">&#128465</button>
                    </form>

                    <!-- Gumb za izmjenu korisnika -->
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUsersModal{{ $task->id }}">
                    &#128587;
                    </button>
                </td>
            </tr>          

            
            <!-- Modal za izmjenu korisnika -->
            <div class="modal fade" id="editUsersModal{{ $task->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modalLabel{{ $task->id }}">Izmjena korisnika za task "{{ $task->task_code }} - {{ $task->task_name }}"</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zatvori"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Forma za dodavanje korisnika -->
                            <form action="{{ route('tasks.assignUser', $task->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="userSelect" class="form-label">Dodaj korisnika:</label>
                                    <select name="user_id" class="form-control">
                                        <option value="">Odaberi korisnika</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                            @if ($user->id != 1)
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Dodijeli</button>
                            </form>

                            <!-- Prikaz i uklanjanje dodijeljenih korisnika -->
                            @if ($task->users->count())
                                <h6 class="mt-4">Trenutno dodijeljeni korisnici:</h6>
                                <ul class="list-group">
                                    @foreach ($task->users as $user)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $user->first_name }} {{ $user->last_name }}
                                            <form action="{{ route('tasks.removeUser', [$task->id, $user->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Jeste li sigurni da želite ukloniti ovog korisnika?')">Ukloni</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <em class="mt-2"><br><br>Nema trenutno dodijeljenih korisnika.</em>
                            @endif
                        </div>
                    </div>
                </div>
</div>






            @empty
            <tr>
                <td colspan="6" class="text-center">Nema dostupnih taskova.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection