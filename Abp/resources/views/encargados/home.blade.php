<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodavento - Encargado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #f8f9fa;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
        }
        header .logo span {
            font-size: 0.9rem;
            color: #6c757d;
            display: block;
        }
        header .btn-logout {
            border: 1px solid #6c757d;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #000;
            text-decoration: none;
            transition: all 0.2s;
        }
        header .btn-logout:hover {
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
        }
        main {
            flex: 1;
        }
        .welcome {
            text-align: center;
            padding: 50px 20px;
            background-color: #f8f9fa;
        }
        .welcome h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .welcome p {
            font-size: 1.2rem;
            color: #6c757d;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .alert {
            border-radius: 10px;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 3px 0;
        }
    </style>
</head>
<body>

<!-- Header -->
<header>
    <div class="logo">
        RODAVENTO
        <span>Hotel · Spa · Aventura</span>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-logout">Cerrar sesión</button>
    </form>
</header>

<!-- Contenido Principal -->
<main>
    <div class="welcome">
        <h1>Bienvenido, <span class="text-primary">{{ Auth::user()->nom }} {{ Auth::user()->ap }} {{ Auth::user()->am }}</span>!</h1>
        <p>Este es tu panel como encargado. Aquí puedes ver tus actividades asignadas y mantenimientos realizados.</p>
    </div>

    <!-- Actividades Asignadas -->
    <div class="container my-5">
        <h2 class="mb-4 text-center">Actividades Asignadas</h2>
        @if($actividades->isEmpty())
            <div class="alert alert-info text-center">
                <p>No tienes actividades asignadas actualmente.</p>
            </div>
        @else
            @foreach($actividades as $actividad)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $actividad->nom_act }}</h5>
                        <p class="card-text">Fecha Asignada: {{ $actividad->fecha_asignada }}</p>
                        <p class="card-text">Estado: {{ $actividad->estadoActividad->desc_estado_a }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Mantenimientos Realizados -->
    <div class="container my-5">
        <h2 class="mb-4 text-center">Mantenimientos Realizados</h2>
        @if($mantenimientos->isEmpty())
            <div class="alert alert-info text-center">
                <p>No tienes mantenimientos registrados.</p>
            </div>
        @else
            @foreach($mantenimientos as $mantenimiento)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Material: {{ $mantenimiento->material->nombre ?? 'No especificado' }}</h5>
                        <p class="card-text">Fecha de Mantenimiento: {{ $mantenimiento->fecha_mantenimiento }}</p>
                        <p class="card-text">Tipo de Mantenimiento: {{ $mantenimiento->tipoMantenimiento->nombre ?? 'No especificado' }}</p>
                        <p class="card-text">Observaciones: {{ $mantenimiento->observaciones }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <p class="mb-2">
        <strong>RODAVENTO</strong><br>
        Hotel · Spa · Aventura
    </p>
    <small>© Desarrollado por Equipo Edson · Ariana · Oscar</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
