@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Crear Nuevo Rol</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom_rol" class="form-label">Nombre del Rol</label>
            <input type="text" name="nom_rol" id="nom_rol" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Rol</button>
    </form>
</div>
@endsection
