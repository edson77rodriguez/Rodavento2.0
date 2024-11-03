@extends('admin.dashboard')

@section('template_title')
    Asignar Actividades
@endsection

@section('crud_content')
<div class="container py-5">
    <h1 class="text-center">Asignar Actividades</h1>
    <div class="card-header mb-4">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Asignaciones de Actividades') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createAsignacionModal">
                    {{ __('Crear Nueva Asignación') }}
                </button>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Guía</th>
                <th>Supervisor</th>
                <th>Encargado</th>
                <th>Actividad</th>
                <th>Fecha Asignada</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asignaciones as $asignacion)
                <tr>
                    <td>{{ $asignacion->guia->user->nom }} {{ $asignacion->guia->user->ap }} </td>
                    <td>{{ $asignacion->supervisor->user->nom }} {{ $asignacion->supervisor->user->ap }} </td>
                    <td>{{ $asignacion->encargado->user->nom }} {{ $asignacion->encargado->user->ap }} </td>
                    <td>{{ $asignacion->actividad->nom_act }}</td>
                    <td>{{ $asignacion->fecha_asignada }}</td>
                    <td>{{ $asignacion->estadoActividad->desc_estado_a }}</td>
                    <td>
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewAsignacionModal{{ $asignacion->id }}">Ver</button>
                        <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editAsignacionModal{{ $asignacion->id }}">Editar</button>
                        <form action="{{ route('asignar_actividades.destroy', $asignacion->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $asignacion->id }}')">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Ver Asignación -->
                <div class="modal fade" id="viewAsignacionModal{{ $asignacion->id }}" tabindex="-1" aria-labelledby="viewAsignacionModalLabel{{ $asignacion->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewAsignacionModalLabel{{ $asignacion->id }}">Detalles de la Asignación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $asignacion->id }}</p>
                                <p><strong>Guía:</strong> {{ $asignacion->guia->user->nom }} {{ $asignacion->guia->user->ap }} {{ $asignacion->guia->user->am }}</p>
                                <p><strong>Supervisor:</strong> {{ $asignacion->supervisor->user->nom }} {{ $asignacion->supervisor->user->ap }} {{ $asignacion->supervisor->user->am }}</p>
                                <p><strong>Encargado:</strong> {{ $asignacion->encargado->user->nom }} {{ $asignacion->encargado->user->ap }} {{ $asignacion->encargado->user->am }}</p>
                                <p><strong>Actividad:</strong> {{ $asignacion->actividad->nom_act }}</p>
                                <p><strong>Fecha Asignada:</strong> {{ $asignacion->fecha_asignada }}</p>
                                <p><strong>Estado:</strong> {{ $asignacion->estadoActividad->desc_estado_a }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Asignación -->
                <div class="modal fade" id="editAsignacionModal{{ $asignacion->id }}" tabindex="-1" aria-labelledby="editAsignacionModalLabel{{ $asignacion->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAsignacionModalLabel{{ $asignacion->id }}">Editar Asignación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('asignar_actividades.update', $asignacion->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="guia_id" class="form-label">Guía</label>
                                        <select name="guia_id" id="guia_id" class="form-select" required>
                                            @foreach ($guias as $guia)
                                                <option value="{{ $guia->id }}" {{ $asignacion->guia_id == $guia->id ? 'selected' : '' }}>{{ $guia->user->nom }} {{ $guia->user->ap }} {{ $guia->user->am }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="supervisor_id" class="form-label">Supervisor</label>
                                        <select name="supervisor_id" id="supervisor_id" class="form-select" required>
                                            @foreach ($supervisores as $supervisor)
                                                <option value="{{ $supervisor->id }}" {{ $asignacion->supervisor_id == $supervisor->id ? 'selected' : '' }}>{{ $supervisor->user->nom }} {{ $supervisor->user->ap }} {{ $supervisor->user->am }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="encargado_id" class="form-label">Encargado</label>
                                        <select name="encargado_id" id="encargado_id" class="form-select" required>
                                            @foreach ($encargados as $encargado)
                                                <option value="{{ $encargado->id }}" {{ $asignacion->encargado_id == $encargado->id ? 'selected' : '' }}>{{ $encargado->user->nom }} {{ $encargado->user->ap }} {{ $encargado->user->am }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="actividad_id" class="form-label">Actividad</label>
                                        <select name="actividad_id" id="actividad_id" class="form-select" required>
                                            @foreach ($actividades as $actividad)
                                                <option value="{{ $actividad->id }}" {{ $asignacion->actividad_id == $actividad->id ? 'selected' : '' }}>{{ $actividad->nom_act }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_asignada" class="form-label">Fecha Asignada</label>
                                        <input type="date" name="fecha_asignada" id="fecha_asignada" value="{{ $asignacion->fecha_asignada }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="estado_a_id" class="form-label">Estado</label>
                                        <select name="estado_a_id" id="estado_a_id" class="form-select" required>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}" {{ $asignacion->estado_a_id == $estado->id ? 'selected' : '' }}>{{ $estado->desc_estado_a }}</option>
                                            @endforeach
                                        </select>
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
                    <h5 class="modal-title" id="createAsignacionModalLabel">Crear Nueva Asignación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('asignar_actividades.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="guia_id" class="form-label">Guía</label>
                            <select name="guia_id" id="guia_id" class="form-select" required>
                                @foreach ($guias as $guia)
                                    <option value="{{ $guia->id }}">{{ $guia->user->nom }} {{ $guia->user->ap }} {{ $guia->user->am }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="supervisor_id" class="form-label">Supervisor</label>
                            <select name="supervisor_id" id="supervisor_id" class="form-select" required>
                                @foreach ($supervisores as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->user->nom }} {{ $supervisor->user->ap }} {{ $supervisor->user->am }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="encargado_id" class="form-label">Encargado</label>
                            <select name="encargado_id" id="encargado_id" class="form-select" required>
                                @foreach ($encargados as $encargado)
                                    <option value="{{ $encargado->id }}">{{ $encargado->user->nom }} {{ $encargado->user->ap }} {{ $encargado->user->am }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="actividad_id" class="form-label">Actividad</label>
                            <select name="actividad_id" id="actividad_id" class="form-select" required>
                                @foreach ($actividades as $actividad)
                                    <option value="{{ $actividad->id }}">{{ $actividad->nom_act }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_asignada" class="form-label">Fecha Asignada</label>
                            <input type="date" name="fecha_asignada" id="fecha_asignada" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado_a_id" class="form-label">Estado</label>
                            <select name="estado_a_id" id="estado_a_id" class="form-select" required>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->desc_estado_a }}</option>
                                @endforeach
                            </select>
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
            text: '¿Estás seguro de que deseas eliminar esta asignacion?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST'; 
                form.action = '/asignar actividades/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
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

