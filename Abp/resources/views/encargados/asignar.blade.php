@extends('admin.dashboard')

@section('crud_content')
<div class="container">
    <h1>Asignar Área a Encargado</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>{{ $user->nom }} {{ $user->ap }} {{ $user->am }}</h3>
            <p>Email: {{ $user->email }}</p>
            <p>Teléfono: {{ $user->telefono }}</p>
        </div>
        <div class="card-body">
            <form action="{{ route('encargados.asignar', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="area_id">Seleccionar Área:</label>
                    <select name="area_id" id="area_id" class="form-control" required>
                        <option value="">Seleccionar Área</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Asignar Área</button>
                <a href="{{ route('encargados.index') }}" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
@endsection
