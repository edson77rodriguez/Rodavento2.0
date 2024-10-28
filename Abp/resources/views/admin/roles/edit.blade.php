@extends('admin.dashboard')

@section('crud_content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Aquí se puede añadir más lógica si es necesario
        });
    </script>

    <div class="container">
        <h1>Editar Rol: {{ $rol->nom_rol }}</h1>
        <form action="{{ route('roles.update', $rol->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom_rol" class="form-label">Nombre del Rol</label>
                <input type="text" name="nom_rol" id="nom_rol" class="form-control" value="{{ $rol->nom_rol }}" required>
            </div>

            <div class="form-group">
                <label>Seleccionar Permisos:</label>
                <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#permissionsModal">
                    Seleccionar Permisos
                </button>

                <!-- Modal para la selección de permisos -->
                <div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="permissionsModalLabel">Seleccionar Permisos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                               id="permission_{{ $permission->id }}"
                                               @if($rol->hasPermissionTo($permission->name)) checked @endif>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            {{ ucfirst($permission->name) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar Rol</button>
        </form>
    </div>
@endsection
