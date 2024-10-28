@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Editar Rol: {{ $rol->nom_rol }}</h1>
    <form action="{{ route('roles.update', $rol->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom_rol" class="form-label">Nombre del Rol</label>
            <input type="text" name="nom_rol" id="nom_rol" class="form-control" value="{{ $rol->nom_rol }}" required>
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Permisos</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
    @foreach ($permissions as $permission)
        <option value="{{ $permission->name }}" 
            {{ $rol->hasPermissionTo($permission->name) ? 'selected' : '' }}>
            {{ $permission->name }}
        </option>
    @endforeach
</select>




        </div>
        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
    </form>
</div>
@endsection
