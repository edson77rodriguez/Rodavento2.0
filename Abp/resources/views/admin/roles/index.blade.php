@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Roles Registrados</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Rol</th>
                <th>Permisos Asignados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $rol)
                <tr>
                    <td>{{ $rol->nom_rol }}</td>
                    <td>
                        @if($rol->permissions->isEmpty())
                            Sin permisos
                        @else
                            <ul>
                                @foreach ($rol->permissions as $permission)
                                    <li>{{ $permission->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este rol?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('roles.create') }}" class="btn btn-success">Crear Nuevo Rol</a>
</div>
@endsection
