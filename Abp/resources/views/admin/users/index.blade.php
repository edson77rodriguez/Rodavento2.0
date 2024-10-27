@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Usuarios Registrados</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nom }} {{ $user->ap }} {{ $user->am }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->rol->nom_rol }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar Rol</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
