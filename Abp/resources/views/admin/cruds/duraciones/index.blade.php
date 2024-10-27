@extends('admin.dashboard')

@section('template_title')
    Duraciones
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Duraciones') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createDuracionModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <div class="row">
        @foreach ($duraciones as $duracion)
            <div class="col-lg-4 col-md-4 col-sm-6 mb-6">
                <div class="card h-100"> <!-- Añadido h-100 para que la tarjeta ocupe todo el espacio disponible -->
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $duracion->desc_duracion }}</h5>
                        <p class="card-text"><strong>Id:</strong> {{ $duracion->id }}</p>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewDuracionModal{{ $duracion->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editDuracionModal{{ $duracion->id }}">Editar</button>
                            <form action="{{ route('duraciones.destroy', $duracion->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $duracion->id }}')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Modal Ver Direccion -->
                <div class="modal fade" id="viewDuracionModal{{ $duracion->id }}" tabindex="-1" aria-labelledby="viewDuracionModalLabel{{ $duracion->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewDuracionModalLabel{{ $duracion->id }}">Detalles de la Dirección</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $duracion->id }}</p>
                                <p><strong>Descripción:</strong> {{ $duracion->desc_duracion }}</p>
                                <!-- Agrega más detalles si es necesario -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Direccion -->
                <div class="modal fade" id="editDuracionModal{{ $duracion->id }}" tabindex="-1" aria-labelledby="editDuracionModalLabel{{ $direccion->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDuracionModalLabel{{ $duracion->id }}">Editar Duracion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('duraciones.update', $duracion->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="desc_duracion{{ $duracion->id }}" class="form-label">Duración</label>
                                        <input type="text" name="desc_duracion" id="desc_duracion{{ $duracion->id }}" value="{{ old('duracion', $duracion->desc_duracion) }}" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Crear Direccion -->
    <div class="modal fade" id="createDuracionModal" tabindex="-1" aria-labelledby="createDuracionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDuracionModalLabel">Crear Nueva Dirección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('duraciones.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="desc_duracion" class="form-label">Descripción</label>
                            <input type="text" name="desc_duracion" id="desc_duracion" class="form-control" required>
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
            text: '¿Estás seguro de que deseas eliminar esta duracion?',
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
                form.action = '/duraciones/' + id;
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
