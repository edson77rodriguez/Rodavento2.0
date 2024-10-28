@extends('admin.dashboard')

@section('template_title')
    Asignar habilidades de guia
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Asignar habilidades Guías') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createAsignarGuiaModal">
                    {{ __('Crear Nueva Asignación') }}
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            @foreach ($asignarGuias as $asignarGuia)
                <div class="col-lg-4 col-md-4 col-sm-6 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $asignarGuia->user->name }}</h5>
                            <p class="card-text"><strong>ID:</strong> {{ $asignarGuia->id }}</p>

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewAsignarGuiaModal{{ $asignarGuia->id }}">Ver</button>
                                <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editAsignarGuiaModal{{ $asignarGuia->id }}">Editar</button>
                                <form action="{{ route('asignar_guias.destroy', $asignarGuia->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $asignarGuia->id }}')">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Ver Asignación -->
                <div class="modal fade" id="viewAsignarGuiaModal{{ $asignarGuia->id }}" tabindex="-1" aria-labelledby="viewAsignarGuiaModalLabel{{ $asignarGuia->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewAsignarGuiaModalLabel{{ $asignarGuia->id }}">Detalles de la Asignación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> {{ $asignarGuia->id }}</p>
                                <p><strong>Usuario:</strong> {{ $asignarGuia->user->name }}</p>
                                <p><strong>Habilidad:</strong> {{ $asignarGuia->habilidad->nombre }}</p>
                                <p><strong>Fecha Emisión:</strong> {{ $asignarGuia->fecha_emsion }}</p>
                                <p><strong>Fecha Vencimiento:</strong> {{ $asignarGuia->fecha_vencimiento }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Asignación -->
                <div class="modal fade" id="editAsignarGuiaModal{{ $asignarGuia->id }}" tabindex="-1" aria-labelledby="editAsignarGuiaModalLabel{{ $asignarGuia->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAsignarGuiaModalLabel{{ $asignarGuia->id }}">Editar Asignación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('asignar_guias.update', $asignarGuia->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="user_id{{ $asignarGuia->id }}" class="form-label">Usuario</label>
                                        <select name="user_id" id="user_id{{ $asignarGuia->id }}" class="form-control" required>
                                            @foreach($usuarios as $usuario)
                                                <option value="{{ $usuario->id }}" {{ $usuario->id == $asignarGuia->user_id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="habilidad_id{{ $asignarGuia->id }}" class="form-label">Habilidad</label>
                                        <select name="habilidad_id" id="habilidad_id{{ $asignarGuia->id }}" class="form-control" required>
                                            @foreach($habilidades as $habilidad)
                                                <option value="{{ $habilidad->id }}" {{ $habilidad->id == $asignarGuia->habilidad_id ? 'selected' : '' }}>{{ $habilidad->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_emsion{{ $asignarGuia->id }}" class="form-label">Fecha Emisión</label>
                                        <input type="date" name="fecha_emsion" id="fecha_emsion{{ $asignarGuia->id }}" value="{{ $asignarGuia->fecha_emsion }}" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_vencimiento{{ $asignarGuia->id }}" class="form-label">Fecha Vencimiento</label>
                                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento{{ $asignarGuia->id }}" value="{{ $asignarGuia->fecha_vencimiento }}" class="form-control" required>
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
</div>

<!-- Modal Crear Nueva Asignación -->
<div class="modal fade" id="createAsignarGuiaModal" tabindex="-1" aria-labelledby="createAsignarGuiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAsignarGuiaModalLabel">Crear Nueva Asignación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('asignar_guias.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuario</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="habilidad_id" class="form-label">Habilidad</label>
                        <select name="habilidad_id" id="habilidad_id" class="form-control" required>
                            @foreach($habilidades as $habilidad)
                                <option value="{{ $habilidad->id }}">{{ $habilidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_emsion" class="form-label">Fecha Emisión</label>
                        <input type="date" name="fecha_emsion" id="fecha_emsion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("¿Está seguro de que desea eliminar esta asignación?")) {
            document.querySelector(`form[action*='${id}']`).submit();
        }
    }
</script>
@endsection
