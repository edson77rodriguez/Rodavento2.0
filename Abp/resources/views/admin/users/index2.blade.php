@extends('admin.dashboard')

@section('crud_content')
@if(Auth::user()->rol_id == 1) <!-- Suponiendo que 1 es el ID del rol de "admin" -->

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol Solicitado</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($users->isEmpty())
                <tr>
                    <td colspan="5">No hay usuarios disponibles.</td>
                </tr>
            @else
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->nom }} {{ $user->ap }} {{ $user->am }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rol->nom_rol }}</td>
                        <td>
                            @if($user->is_approved)
                                Aprobado
                            @else
                                Pendiente
                            @endif
                        </td>
                        <td>
                            @if(!$user->is_approved)
                                <form action="{{ route('users.approve', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Aprobar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    
@endif
@endsection
