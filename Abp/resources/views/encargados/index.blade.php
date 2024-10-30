@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Encargados Registrados</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nom }} {{ $user->ap }} {{ $user->am }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>
                        <a href="{{ route('encargados.asignar', $user->id) }}" class="btn btn-primary">Asignar Área</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
