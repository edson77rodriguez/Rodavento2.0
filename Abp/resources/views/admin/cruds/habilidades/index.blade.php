@extends('admin.dashboard')

@section('template_title')
    Habilidades
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Habilidades') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createHabilidadModal">
                    {{ __('Crear Nueva Habilidad') }}
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach ($habilidades as $habilidad)
                <div class="col-lg-4 col-md-4 col-sm-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $habilidad->nom_hab }}</h5>
                            <p class="card-text"><strong>ID:</strong> {{ $habilidad->id }}</p>
                            <p class="card-text"><strong>Descripcion:</strong> {{ $habilidad->desc_habilidad }}</p>

                                            

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewHabilidadModal{{ $habilidad->id }}">Ver</button>
                                <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editHabilidadModal{{ $habilidad->id }}">Editar</button>
                                <form id="delete-form-{{ $habilidad->id }}" action="{{ route('habilidades.destroy', $habilidad->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $habilidad->id }}')">Eliminar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Ver Habilidad -->
                <div class="modal fade" id="viewHabilidadModal{{ $habilidad->id }}" tabindex="-1" aria-labelledby="viewHabilidadModalLabel{{ $habilidad->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewHabilidadModalLabel{{ $habilidad->id }}">Detalles de la Habilidad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $habilidad->id }}</p>
                                <p><strong>Nombre:</strong> {{ $habilidad->nom_hab }}</p>
                                <p><strong>Descripción:</strong> {{ $habilidad->desc_habilidad }} </p>
                               
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Habilidad -->
                <div class="modal fade" id="editHabilidadModal{{ $habilidad->id }}" tabindex="-1" aria-labelledby="editHabilidadModalLabel{{ $habilidad->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editHabilidadModalLabel{{ $habilidad->id }}">Editar Habilidad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('habilidades.update', $habilidad->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nom_hab{{ $habilidad->id }}" class="form-label">Nombre Habilidad</label>
                                        <input type="text" name="nom_hab" id="nom_hab{{ $habilidad->id }}" value="{{ old('nom_hab', $habilidad->nom_hab) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="desc_habilidad{{ $habilidad->id }}" class="form-label">Descripción</label>
                                        <input type="text" name="desc_habilidad" id="desc_habilidad{{ $habilidad->id }}" value="{{ old('desc_habilidad', $habilidad->desc_habilidad) }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="t_habilidad_id{{ $habilidad->id }}" class="form-label">Tipo de Habilidad</label>
                                        <select name="t_habilidad_id" id="t_habilidad_id{{ $habilidad->id }}" class="form-control" required>
                                            @foreach($t_habilidades as $tipo)
                                                <option value="{{ $tipo->id }}" {{ $tipo->id == $habilidad->t_habilidad_id ? 'selected' : '' }}>{{ $tipo->desc_t }}</option>
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
        </div>
    </div>

    <!-- Modal Crear Habilidad -->
    <div class="modal fade" id="createHabilidadModal" tabindex="-1" aria-labelledby="createHabilidadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createHabilidadModalLabel">Crear Nueva Habilidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('habilidades.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom_hab" class="form-label">Nombre Habilidad</label>
                            <input type="text" name="nom_hab" id="nom_hab" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc_habilidad" class="form-label">Descripción</label>
                            <input type="text" name="desc_habilidad" id="desc_habilidad" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="t_habilidad_id" class="form-label">Tipo de Habilidad</label>
                            <select name="t_habilidad_id" id="t_habilidad_id" class="form-control" required>
                                @foreach($t_habilidades as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->desc_t }}</option>
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
        text: '¿Estás seguro de que deseas eliminar esta habilidad?',
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

