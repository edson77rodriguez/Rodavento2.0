@extends('layouts.app')

@section('title', 'Inicio - Guía')

@section('content')
<div class="welcome">
    <h1>Bienvenido, {{ $user->nom }} {{ $user->ap }} {{ $user->am }}!</h1>
</div>



<h2>Actividades Asignadas</h2>
<div class="menu">
    @if($actividades->isEmpty())
        <p>No tienes actividades asignadas actualmente.</p>
    @else
        @foreach($actividades as $actividad)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $actividad->actividad->nom_act }}</h5>
                    <p class="card-text">Fecha Asignada: {{ $actividad->fecha_asignada }}</p>
                    <p class="card-text">Estado: {{ $actividad->estadoActividad->desc_estado_a }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>

<h2>Perfil</h2>
<form action="{{ route('update.disponibilidad') }}" method="POST">
    @csrf
    <label for="disponibilidad">¿Disponible?</label>
    <select name="disponibilidad" id="disponibilidad">
        <option value="true" {{ $guia && $guia->disponibilidad ? 'selected' : '' }}>Sí</option>
        <option value="false" {{ $guia && !$guia->disponibilidad ? 'selected' : '' }}>No</option>
    </select>
    <button type="submit">Actualizar Disponibilidad</button>
</form>

@endsection
