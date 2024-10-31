@extends('admin.dashboard')

@section('template_title')
    Materiales
@endsection

@section('crud_content')
<div class="container py-5">
    <h1 class="text-center">Materiales</h1>
    <div class="card-header mb-4">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Materiales') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createAsignacionModal">
                    {{ __('Crear Nueva Material') }}
                </button>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Codigo del material</th>
                <th>Estado del equipo</th>
                <th>Fecha de asignacion</th>
                <th>Fecha de proximo matenimiento</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $material)
                <tr>
                    <td>{{ $material->equipo->nom_equipo }}</td>
                    <td>{{ $material->codigo_m }}  </td>
                    <td>{{ $material->actividad->estadoequipo->desc_estado_e }}</td>
                    <td>{{ $material->fecha_asignacion }}</td>
                    <td>{{ $material->fecha_mantenimiento }}</td>
                    <td>
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewAsignacionModal{{ $material->id }}">Ver</button>
                        <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editAsignacionModal{{ $material->id }}">Editar</button>
                        <form action="{{ route('materiales.destroy', $material->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $material->id }}')">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Ver Asignación -->
                <div class="modal fade" id="viewAsignacionModal{{ $material->id }}" tabindex="-1" aria-labelledby="viewAsignacionModalLabel{{ $material->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewAsignacionModalLabel{{ $material->id }}">Detalles de el material</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $material->id }}</p>
                                <p><strong>Equipo:</strong> {{ $material->equipo->nom_equipo }}</p>
                                <p><strong>Codigo del Equipo:</strong> {{ $material->codigo_m }}</p>
                                <p><strong>Estado:</strong> {{ $material->actividad->estadoequipo->desc_estado_e }}</p>
                                <p><strong>Fecha de asignacion:</strong>{{ $material->fecha_asignacion }}</p>
                                <p><strong>Fecha de proximo mantenimiento:</strong> {{ $material->fecha_mantenimiento }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Asignación -->
                <div class="modal fade" id="editAsignacionModal{{ $material->id }}" tabindex="-1" aria-labelledby="editAsignacionModalLabel{{ $material->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAsignacionModalLabel{{ $material->id }}">Editar Asignación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('materiales.update', $material->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="equipo_id" class="form-label">Equipo</label>
                                        <select name="equipo_id" id="equipo_id" class="form-select" required>
                                            @foreach ($equipos as $equipo)
                                                <option value="{{ $equipo->id }}" {{ $asignacion->equipo == $equipo->id ? 'selected' : '' }}>{{ $equipo->nom_equipo }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                            <label for="codigo_m{{ $material->id }}" class="form-label">Nombre del Equipo</label>
                                            <input type="text" name="codigo_m" id="codigo_m{{ $material->id }}" value="{{ old('codigo_m', $material->codigo_m) }}" class="form-control" required>
                                        </div>

                                    <div class="mb-3">
                                        <label for="estado_e_id" class="form-label">Supervisor</label>
                                        <select name="estado_e_id" id="estado_e_id" class="form-select" required>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}" {{ $asignacion->estado_e_id == $estado->id ? 'selected' : '' }}>{{ $estado->desc_estado_e }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                    <div class="mb-3">
                                        <label for="fecha_asignacion" class="form-label">Fecha Asignada</label>
                                        <input type="date" name="fecha_asignacion" id="fecha_asignacion" value="{{ $material->fecha_asignacion }}" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fecha_mantenimiento" class="form-label">Fecha de proximo mantenimiento</label>
                                        <input type="date" name="fecha_mantenimiento" id="fecha_mantenimiento" value="{{ $material->fecha_mantenimiento }}" class="form-control" required>
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

    <!-- Modal Crear Asignación -->
    <div class="modal fade" id="createAsignacionModal" tabindex="-1" aria-labelledby="createAsignacionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAsignacionModalLabel">Crear Nuevo material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('materiales.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="equipo_id" class="form-label">Guía</label>
                            <select name="equipo_id" id="equipo_id" class="form-select" required>
                                @foreach ($equipos as $equipo)
                                    <option value="{{ $equipo->id }}">{{ $equipo->nom_equipo }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                                <label for="codigo_m" class="form-label">Codigo del equipo</label>
                                <input type="text" name="codigo_m" id="codigo_m" class="form-control" required>
                                 </div>
                        <div class="mb-3">
                            <label for="estado_e_id" class="form-label">Estado: </label>
                            <select name="estado_e_id" id="estado_e_id" class="form-select" required>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->desc_estado_e }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_asignacion" class="form-label">Fecha de Asignacion</label>
                            <input type="date" name="fecha_asignacion" id="fecha_asignacion" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_mantenimiento" class="form-label">Fecha de Mantenimiento</label>
                            <input type="date" name="fecha_mantenimiento" id="fecha_mantenimiento" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Asignación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este material?')) {
        document.querySelector(`form[action*="${id}"]`).submit();
    }
}
</script>
@endsection
