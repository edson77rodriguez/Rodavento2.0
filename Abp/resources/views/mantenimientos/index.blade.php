@extends('admin.dashboard')

@section('template_title')
    Mantenimientos
@endsection

@section('crud_content')
<div class="container py-5">
    <h1 class="text-center">Gestión de Mantenimientos</h1>
    <div class="card-header mb-4">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Listado de Mantenimientos') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createMantenimientoModal">
                    {{ __('Programar Mantenimiento') }}
                </button>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Encargado</th>
                <th>Fecha Programada</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mantenimientos as $mantenimiento)
                <tr>
                    <td>{{ $mantenimiento->material->equipo->nom_equipo }}</td>
                    <td>{{ $mantenimiento->encargado->user->nom }} {{ $mantenimiento->encargado->user->ap }}</td>
                    <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                    <td>{{ $mantenimiento->tipoMantenimiento->nom_tipo }}</td>
                    <td>
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewMantenimientoModal{{ $mantenimiento->id }}">Ver</button>
                        <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editMantenimientoModal{{ $mantenimiento->id }}">Editar</button>
                        <form action="{{ route('mantenimientos.destroy', $mantenimiento->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $mantenimiento->id }}')">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Ver Mantenimiento -->
                <div class="modal fade" id="viewMantenimientoModal{{ $mantenimiento->id }}" tabindex="-1" aria-labelledby="viewMantenimientoModalLabel{{ $mantenimiento->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewMantenimientoModalLabel{{ $mantenimiento->id }}">Detalles del Mantenimiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $mantenimiento->id }}</p>
                                <p><strong>Equipo:</strong> {{ $mantenimiento->material->equipo->nom_equipo }}</p>
                                <p><strong>Encargado:</strong> {{ $mantenimiento->encargado->user->nom }} {{ $mantenimiento->encargado->user->ap }}</p>
                                <p><strong>Fecha Programada:</strong> {{ $mantenimiento->fecha_programada }}</p>
                                <p><strong>Estado:</strong> {{ $mantenimiento->tipoMantenimiento->nom_tipo }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Mantenimiento -->
                <div class="modal fade" id="editMantenimientoModal{{ $mantenimiento->id }}" tabindex="-1" aria-labelledby="editMantenimientoModalLabel{{ $mantenimiento->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editMantenimientoModalLabel{{ $mantenimiento->id }}">Editar Mantenimiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('mantenimientos.update', $mantenimiento->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="tipo_m" class="form-label">Tipo de Mantenimiento</label>
                                        <select name="tipo_m" id="tipo_m" class="form-select" required>
                                            @foreach ($tipos as $tipo)
                                                <option value="{{ $tipo->id }}" {{ $mantenimiento->tipo_m == $tipo->id ? 'selected' : '' }}>{{ $tipo->nom_tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="encargado_id" class="form-label">Encargado</label>
                                        <select name="encargado_id" id="encargado_id" class="form-select" required>
                                            @foreach ($encargados as $encargado)
                                                <option value="{{ $encargado->id }}" {{ $mantenimiento->encargado_id == $encargado->id ? 'selected' : '' }}>{{ $encargado->user->nom }} {{ $encargado->user->ap }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_mantenimiento" class="form-label">Fecha Programada</label>
                                        <input type="date" name="fecha_mantenimiento" id="fecha_mantenimiento" value="{{ $mantenimiento->fecha_mantenimiento }}" class="form-control" required>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Crear Mantenimiento -->
    <div class="modal fade" id="createMantenimientoModal" tabindex="-1" aria-labelledby="createMantenimientoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMantenimientoModalLabel">Programar Mantenimiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('mantenimientos.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="material_id" class="form-label">Material</label>
                            <select name="material_id" id="material_id" class="form-select" required>
                                @foreach ($materiales as $material)
                                    <option value="{{ $material->id }}">{{ $material->equipo->nom_equipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="encargado_id" class="form-label">Encargado</label>
                            <select name="encargado_id" id="encargado_id" class="form-select" required>
                                @foreach ($encargados as $encargado)
                                    <option value="{{ $encargado->id }}">{{ $encargado->user->nom }} {{ $encargado->user->ap }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="mb-3">
                            <label for="tipo_m" class="form-label">Tipo mantenimiento</label>
                            <select name="tipo_m" id="tipo_m" class="form-select" required>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nom_tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="mb-3">
                            <label for="fecha_mantenimiento" class="form-label">Fecha Programada</label>
                            <input type="date" name="fecha_mantenimiento" id="fecha_mantenimiento" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">observaciones</label>
                            <input type="text" name="observaciones" id="observaciones" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Mantenimiento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este mantenimiento?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection
