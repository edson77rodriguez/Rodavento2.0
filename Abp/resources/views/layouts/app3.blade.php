<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Rodavento')</title>
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

        #nuevoCarrusel {
            max-height: 400px;
            overflow: hidden;
        }

        #nuevoCarrusel img {
            object-fit: cover;
            height: 400px;
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
<main class="container mt-5">
    @yield('content')
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
        <a href="#">Políticas COVID</a>
    </p>
    <small>© Desarrollado por Equipo Edson · Ariana · Oscar</small>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
