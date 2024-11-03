@extends('admin.dashboard')

@section('template_title')
    Actividades
@endsection

@section('crud_content')
<div class="container py-5">
    <h1 class="text-center">Actividades Registradas</h1>
    <div class="card-header mb-4">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Actividades') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createActividadModal">
                    {{ __('Crear Nueva Actividad') }}
                </button>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre de Actividad</th>
                <th>Duración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actividades as $actividad)
                <tr>
                    <td>{{ $actividad->nom_act }}</td>
                    <td>{{ $actividad->duracion->desc_duracion ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewActividadModal{{ $actividad->id }}">Ver</button>
                        <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editActividadModal{{ $actividad->id }}">Editar</button>
                        <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $actividad->id }}')">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Ver Actividad -->
                <div class="modal fade" id="viewActividadModal{{ $actividad->id }}" tabindex="-1" aria-labelledby="viewActividadModalLabel{{ $actividad->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewActividadModalLabel{{ $actividad->id }}">Detalles de la Actividad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $actividad->id }}</p>
                                <p><strong>Nombre:</strong> {{ $actividad->nom_act }}</p>
                                <p><strong>Duración:</strong> {{ $actividad->duracion->desc_duracion ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Actividad -->
                <div class="modal fade" id="editActividadModal{{ $actividad->id }}" tabindex="-1" aria-labelledby="editActividadModalLabel{{ $actividad->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editActividadModalLabel{{ $actividad->id }}">Editar Actividad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('actividades.update', $actividad->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nom_act{{ $actividad->id }}" class="form-label">Nombre de Actividad</label>
                                        <input type="text" name="nom_act" id="nom_act{{ $actividad->id }}" value="{{ old('nom_act', $actividad->nom_act) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duracion_id{{ $actividad->id }}" class="form-label">Duración</label>
                                        <select name="duracion_id" id="duracion_id{{ $actividad->id }}" class="form-select" required>
                                            @foreach ($duraciones as $duracion)
                                                <option value="{{ $duracion->id }}" {{ $actividad->duracion_id == $duracion->id ? 'selected' : '' }}>{{ $duracion->desc_duracion }}</option>
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

    <!-- Modal Crear Actividad -->
    <div class="modal fade" id="createActividadModal" tabindex="-1" aria-labelledby="createActividadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createActividadModalLabel">Crear Nueva Actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('actividades.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom_act" class="form-label">Nombre de Actividad</label>
                            <input type="text" name="nom_act" id="nom_act" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="duracion_id" class="form-label">Duración</label>
                            <select name="duracion_id" id="duracion_id" class="form-select" required>
                                <option>Seleccion la duracion de la actividad</option>
                                @foreach ($duraciones as $duracion)
                                    <option value="{{ $duracion->id }}">{{ $duracion->desc_duracion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
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
            text: '¿Estás seguro de que deseas eliminar esta actividad?',
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
                form.action = '/actividades/' + id;
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

