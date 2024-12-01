@extends('admin.dashboard')

@section('template_title')
    Equipos
@endsection

@section('crud_content')
    <div class="container py-5">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">{{ __('Equipos') }}</span>
                <div class="float-right">
                    <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createEquipoModal">
                        {{ __('Create New') }}
                    </button>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                @foreach ($equipos as $equipo)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $equipo->nom_equipo }}</h5>
                                @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador')

                                <p class="card-text"><strong>ID:</strong> {{ $equipo->id_equipo }}</p>
                                @endif
                                <p class="card-text"><strong>Categoría:</strong> {{ $equipo->categoria->desc_cat ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Cantidad:</strong> {{ $equipo->cantidad }}</p>
                                <p class="card-text"><strong>Descripcion:</strong> {{ $equipo->descripcion }}</p>


                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewEquipoModal{{ $equipo->id_equipo }}">Ver</button>
                                    @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador' ||  Auth::user()->rol->nom_rol == 'Supervisor')
 
                                   <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editEquipoModal{{ $equipo->id_equipo }}">Editar</button>
                                    @endif
                                   <form id="delete-form-{{ $equipo->id }}" action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador')
                                    <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $equipo->id }}')">Eliminar</button>
                                    @endif
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Ver Equipo -->
                    <div class="modal fade" id="viewEquipoModal{{ $equipo->id_equipo }}" tabindex="-1" aria-labelledby="viewEquipoModalLabel{{ $equipo->id_equipo }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewEquipoModalLabel{{ $equipo->id_equipo }}">Detalles del Equipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                @if(Auth::user()->rol_id == 1 ||  Auth::user()->rol->nom_rol == 'Administrador')

                                    <p><strong>ID:</strong> {{ $equipo->id_equipo }}</p>
                                    @endif
                                    <p><strong>Nombre:</strong> {{ $equipo->nom_equipo }}</p>
                                    <p><strong>Descripción:</strong> {{ $equipo->descripcion }}</p>
                                    <p><strong>Categoría:</strong> {{ $equipo->categoria->desc_cat ?? 'N/A' }}</p>
                                    <p><strong>Cantidad:</strong> {{ $equipo->cantidad }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Equipo -->
                    <div class="modal fade" id="editEquipoModal{{ $equipo->id_equipo }}" tabindex="-1" aria-labelledby="editEquipoModalLabel{{ $equipo->id_equipo }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEquipoModalLabel{{ $equipo->id_equipo }}">Editar Equipo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('equipos.update', $equipo->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nom_equipo{{ $equipo->id_equipo }}" class="form-label">Nombre del Equipo</label>
                                            <input type="text" name="nom_equipo" id="nom_equipo{{ $equipo->id_equipo }}" value="{{ old('nom_equipo', $equipo->nom_equipo) }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id{{ $equipo->id_equipo }}" class="form-label">Categoría</label>
                                            <select name="categoria_id" id="categoria_id{{ $equipo->id_equipo }}" class="form-control" required>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}" {{ $equipo->id == $categoria->id ? 'selected' : '' }}>
                                                        {{ $categoria->desc_cat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion{{ $equipo->id_equipo }}" class="form-label">Descripcion</label>
                                            <input type="text" name="descripcion" id="descripcion{{ $equipo->id_equipo }}" value="{{ old('descripcion', $equipo->descripcion) }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cantidad{{ $equipo->id_equipo }}" class="form-label">Cantidad</label>
                                            <input type="number" name="cantidad" id="cantidad{{ $equipo->id_equipo }}" value="{{ old('cantidad', $equipo->cantidad) }}" class="form-control" required>
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

        <!-- Modal Crear Equipo -->
        <div class="modal fade" id="createEquipoModal" tabindex="-1" aria-labelledby="createEquipoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEquipoModalLabel">Crear Nuevo Equipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('equipos.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_equipo" class="form-label">Nombre del Equipo</label>
                                <input type="text" name="nom_equipo" id="nom_equipo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="id" class="form-label">Categoría</label>
                                <select name="categoria_id" id="categoria_id" class="form-control" required>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->desc_cat }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion del equipo</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" required>
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
        text: '¿Estás seguro de que deseas eliminar equipo?',
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
