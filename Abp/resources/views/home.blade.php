<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodavento - Guía</title>
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

        .footer a {
            color: #ddd;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer a:hover {
            color: #fff;
            text-decoration: underline;
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

    <!-- Carrusel -->
    <div id="nuevoCarrusel" class="carousel slide" data-bs-ride="carousel" style="max-height: 400px; overflow: hidden;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#nuevoCarrusel" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#nuevoCarrusel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#nuevoCarrusel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/kayak.jpg') }}" class="d-block w-100" alt="Kayak" style="object-fit: cover; height: 400px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Kayak</h5>
                    <p>Explora los ríos y lagos con nuestras actividades de kayak.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/pesca.jpg') }}" class="d-block w-100" alt="Pesca" style="object-fit: cover; height: 400px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Pesca</h5>
                    <p>Disfruta de una relajante experiencia de pesca.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/rappel.jpg') }}" class="d-block w-100" alt="Rappel" style="object-fit: cover; height: 400px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Rappel</h5>
                    <p>Aventura extrema con descensos impresionantes.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#nuevoCarrusel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#nuevoCarrusel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
    <div class="welcome">
        <h1>Bienvenido, <span class="text-primary">{{ Auth::user()->nom}} {{ Auth::user()->ap }} {{ Auth::user()->am }}</span>!</h1>
        <p>Este es tu panel como guía. Aquí puedes gestionar tus actividades y actualizar tu perfil.</p>
    </div>
    <!-- Actividades Section -->
    <div class="container my-5">
        <h2 class="mb-4 text-center">Actividades Asignadas</h2>
        <div class="menu">
            @if($actividades->isEmpty())
                <div class="alert alert-info text-center">
                    <p>No tienes actividades asignadas actualmente.</p>
                </div>
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


        <!-- Asignaciones Section -->
    <div class="container my-5">
        <h2 class="mb-4 text-center">Asignaciones de Materiales</h2>
        <div class="row">
            @if($asignaciones->isEmpty())
                <div class="alert alert-info text-center">
                    <p>No hay asignaciones de materiales disponibles.</p>
                </div>
            @else
                @foreach($asignaciones as $asignacion)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Actividad: {{ $asignacion->actividad->nom_act }}</h5>
                                <p><strong>Material:</strong> {{ $asignacion->material->codigo_m }}</p>
                                <p><strong>Equipo:</strong> {{ $asignacion->material->equipo->nom_equipo ?? 'No especificado' }}</p>
                                <p><strong>Fecha Programada:</strong> {{ $asignacion->fecha_programada }}</p>
                                <p><strong>Fecha Devolución:</strong> {{ $asignacion->fecha_devolucion ?? 'Pendiente' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <p class="mb-2">
        <strong>RODAVENTO</strong><br>
        Hotel · Spa · Aventura
    </p>
    <div>
        <a href="#"><i class="fas fa-envelope"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    <p class="mt-2">
        <a href="#">Aviso de privacidad</a> ·
        <a href="#">Políticas de Desarollo</a>
    </p>
    <small>© Desarrollado por Equipo Edson · Ariana · Oscar</small>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
