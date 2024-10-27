@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Editar Rol de Usuario</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="rol_id">Selecciona un Rol:</label>
            <select name="rol_id" class="form-control" required>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}" {{ $user->rol_id == $rol->id ? 'selected' : '' }}>
                        {{ $rol->nom_rol }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Rol</button>
    </form>
</div>
@endsection
