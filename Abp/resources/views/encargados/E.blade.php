@extends('admin.dashboard') <!-- Asegúrate de usar la plantilla del dashboard -->

@section('crud_content')
<style>
    /* Estilos personalizados para el menú de cartas */
.card {
    transition: transform 0.3s ease-in-out;
    border-radius: 8px; /* Bordes redondeados para un aspecto más moderno */
}

.card:hover {
    transform: translateY(-5px); /* Animación de hover para elevar la carta */
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1); /* Sombra más pronunciada al hacer hover */
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
}

.card-text {
    font-size: 0.95rem;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3; /* Color más oscuro al hacer hover */
}

    </style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Menú de Areas para Encargados y Supervisores</h2>
            <div class="row">
                <!-- Iteración sobre los CRUDs -->
                @foreach ($cruds as $crud)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-primary">{{ $crud['name'] }}</h5>
                <p class="card-text text-muted flex-grow-1">{{ $crud['description'] }}</p>
                <a href="{{ route($crud['route']) }}" class="btn btn-primary mt-auto">Gestionar {{ $crud['name'] }}</a>
            </div>
        </div>
    </div>
@endforeach

            </div>
        </div>
    </div>
</div>
@endsection
