<!-- resources/views/admin/roles/show.blade.php -->
@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Detalles del Rol: {{ $rol->nom_rol }}</h1>

    <ul>
        <li>ID: {{ $rol->id }}</li>
        <li>Nombre: {{ $rol->nom_rol }}</li>
        <li>Permisos:</li>
        <ul>
            @foreach ($rol->permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>
    </ul>

    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
