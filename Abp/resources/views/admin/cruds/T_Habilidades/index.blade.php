@extends('admin.dashboard')

@section('template_title')
    Tipo habilidades
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Tipo Habilidades') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createT_habilidadModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <div class="row">
        @foreach ($t_habilidades as $t_habilidad)
            <div class="col-lg-4 col-md-4 col-sm-6 mb-6">
                <div class="card h-100"> <!-- Añadido h-100 para que la tarjeta ocupe todo el espacio disponible -->
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $t_habilidad->desc_t }}</h5>
                        <p class="card-text"><strong>Id:</strong> {{ $t_habilidad->id }}</p>

                        <div class="d-flex justify-content-between">
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewT_habilidadModal{{ $t_habilidad->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editT_habilidadModal{{ $t_habilidad->id }}">Editar</button>
                            <form action="{{ route('t_habilidades.destroy', $t_habilidad->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $t_habilidad->id }}')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Modal Ver Direccion -->
                <div class="modal fade" id="viewT_habilidadModal{{ $t_habilidad->id }}" tabindex="-1" aria-labelledby="viewT_habilidadModalLabel{{ $t_habilidad->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewT_habilidadModalLabel{{ $t_habilidad->id }}">Detalles de la Tipo habilidad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $t_habilidad->id }}</p>
                                <p><strong>Descripción:</strong> {{ $t_habilidad->desc_t }}</p>
                                <!-- Agrega más detalles si es necesario -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Direccion -->
                <div class="modal fade" id="editT_habilidadModal{{ $t_habilidad->id }}" tabindex="-1" aria-labelledby="editT_habilidadModalLabel{{ $t_habilidad->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editT_habilidadModalLabel{{ $t_habilidad->id }}">Editar Dirección</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('t_habilidades.update', $t_habilidad->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="desc_t{{ $direccion->id }}" class="form-label">Dirección</label>
                                        <input type="text" name="desc_t" id="desc_t{{ $t_habilidad->id }}" value="{{ old('t_habilidad', $t_habilidad->desc_t) }}" class="form-control" required>
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
    <div class="modal fade" id="createT_habilidadModal" tabindex="-1" aria-labelledby="createT_habilidadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createT_habilidadModalLabel">Crear Nueva Tipo habilidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('t_habilidades.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="desc_t" class="form-label">Descripción</label>
                            <input type="text" name="desc_t" id="desc_t" class="form-control" required>
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
            text: '¿Estás seguro de que deseas eliminar esta tipo habilidad?',
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
                form.action = '/t_habilidades/' + id;
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
