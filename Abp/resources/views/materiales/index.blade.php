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
                    <td>{{ $material->estadoequipo->desc_estado_e }}</td>
                    <td>{{ $material->fecha_asignacion }}</td>
                    <td>{{ $material->fecha_mantenimiento }}</td>
                    <td>
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewAsignacionModal{{ $material->id }}">Ver</button>
                        @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador' ||  Auth::user()->rol->nom_rol == 'Supervisor')
                        <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editAsignacionModal{{ $material->id }}">Editar</button>
                        @endif
                        <form id="delete-form-{{ $material->id }}" action="{{ route('materiales.destroy', $material->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador')
                                    <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $material->id }}')">Eliminar</button>
                                    @endif
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
                            @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador' ||  Auth::user()->rol->nom_rol == 'Supervisor')
                                <p><strong>ID:</strong> {{ $material->id }}</p>
                                @endif
                                <p><strong>Equipo:</strong> {{ $material->equipo->nom_equipo }}</p>
                                <p><strong>Codigo del Equipo:</strong> {{ $material->codigo_m }}</p>
                                <p><strong>Estado:</strong> {{ $material->estadoequipo->desc_estado_e }}</p>
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
                                                <option value="{{ $equipo->id }}" {{ $material->id_equipo == $equipo->id ? 'selected' : '' }}>{{ $equipo->nom_equipo }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador')
                                    <div class="mb-3">
                                            <label for="codigo_m{{ $material->id }}" class="form-label">Nombre del Equipo</label>
                                            <input type="text" name="codigo_m" id="codigo_m{{ $material->id }}" value="{{ old('codigo_m', $material->codigo_m) }}" class="form-control" required>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="estado_e_id" class="form-label">Estado del equipo</label>
                                        <select name="estado_e_id" id="estado_e_id" class="form-select" required>
                                            
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}" {{ $material->estado_e_id == $estado->id ? 'selected' : '' }}>{{ $estado->desc_estado_e }} </option>
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
                                <label for="codigo_m" class="form-label">Codigo del equipo</label>
                                <input type="text" name="codigo_m" id="codigo_m" class="form-control" required>
                                 </div>

                        <div class="mb-3">
                            <label for="id_equipo" class="form-label">Equipo</label>
                            <select name="id_equipo" id="id_equipo" class="form-select" required>
                            <option>Selecciona un equipo</option>    
                            @foreach ($equipos as $equipo)
                                    <option value="{{ $equipo->id }}">{{ $equipo->nom_equipo }} </option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="mb-3">
                            <label for="estado_e_id" class="form-label">Estado: </label>
                            <select name="estado_e_id" id="estado_e_id" class="form-select" required>
                            <option>Selecciona un estado de equipo</option>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/kJF/b7ICQ1Zfs0cQ45oM0v4lL+SzR0t4i0p54K/xY8q3jOAV5tQ9l" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    function confirmDelete(id) {
    Swal.fire({
        title: 'Eliminar',
        text: '¿Estás seguro de que deseas eliminar este material?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}
    function RegistroExitoso() {
        Swal.fire({
            icon: 'success',
            title: 'Registro exitoso',
            text: 'Tu registro ha sido exitoso',
            timer: 1300,
            showConfirmButton: false
        });
    }
    function cambio() {
        Swal.fire({
            icon: 'success',
            title: 'Cambio generado',
            text: ' ',
            timer: 1400,
            showConfirmButton: false
        });
    }
</script>

@if(session('register'))
    <script>
        RegistroExitoso();
    </script>
@endif
@if(session('modify'))
    <script>
        cambio();
    </script>
@endif
@if(session('destroy'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: 'El elemento ha sido eliminado exitosamente',
            timer: 1200,
            showConfirmButton: false
        });
    </script>
@endif
@endsection