@extends('admin.dashboard')

@section('template_title')
    Tipo Mantenimientos
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Tipo Mantenimientos') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createT_MantenimientoModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <div class="row">
        @foreach ($t__mantenimientos as $t_mantenimiento)
            <div class="col-lg-4 col-md-4 col-sm-6 mb-6">
                <div class="card h-100"> <!-- Añadido h-100 para que la tarjeta ocupe todo el espacio disponible -->
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $t_mantenimiento->nom_tipo }}</h5>
                        <p class="card-text"><strong>Id:</strong> {{ $t_mantenimiento->id }}</p>
                        <p class="card-text"><strong>Descripcion:</strong> {{ $t_mantenimiento->desc_m }}</p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewT_MantenimientoModal{{ $t_mantenimiento->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editT_MantenimientoModal{{ $t_mantenimiento->id }}">Editar</button>
                            <form id="delete-form-{{ $t_mantenimiento->id }}" action="{{ route('t_mantenimientos.destroy', $t_mantenimiento->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $t_mantenimiento->id }}')">Eliminar</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Modal Ver Direccion -->
                <div class="modal fade" id="viewT_MantenimientoModal{{ $t_mantenimiento->id }}" tabindex="-1" aria-labelledby="viewT_MantenimientoModalLabel{{ $t_mantenimiento->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewT_MantenimientoModalLabel{{ $t_mantenimiento->id }}">Detalles de la Tipo de Mantenimiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $t_mantenimiento->id }}</p>
                                <p><strong>Nombre:</strong> {{ $t_mantenimiento->nom_tipo }}</p>
                                <p><strong>Descripción:</strong> {{ $t_mantenimiento->desc_m }}</p>
                                <!-- Agrega más detalles si es necesario -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Direccion -->
                <div class="modal fade" id="editT_MantenimientoModal{{ $t_mantenimiento->id }}" tabindex="-1" aria-labelledby="editT_MantenimientoModalLabel{{ $t_mantenimiento->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editT_MantenimientoModalLabel{{ $t_mantenimiento->id }}">Editar Tipo de mantenimiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('t_mantenimientos.update', $t_mantenimiento->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nom_tipo{{ $t_mantenimiento->id }}" class="form-label">Mantenimiento:</label>
                                        <input type="text" name="nom_tipo" id="nom_tipo{{ $t_mantenimiento->id }}" value="{{ old('t_mantenimiento', $t_mantenimiento->nom_tipo) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="desc_m{{ $t_mantenimiento->id }}" class="form-label">Descripcion de mantenimiento</label>
                                        <input type="text" name="desc_m" id="desc_m{{ $t_mantenimiento->id }}" value="{{ old('t_mantenimiento', $t_mantenimiento->desc_m) }}" class="form-control" required>
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

   <!-- Modal Crear Tipo de Mantenimiento -->
<div class="modal fade" id="createT_MantenimientoModal" tabindex="-1" aria-labelledby="createT_MantenimientoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createT_MantenimientoModalLabel">Crear Nuevo Tipo de Mantenimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('t_mantenimientos.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nom_tipo" class="form-label">Mantenimiento:</label>
                        <input type="text" name="nom_tipo" id="nom_tipo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="desc_m" class="form-label">Descripción:</label>
                        <input type="text" name="desc_m" id="desc_m" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
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
        text: '¿Estás seguro de que deseas eliminar este tipo de mantenimiento?',
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
