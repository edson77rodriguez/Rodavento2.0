<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido, {{ $user->nom }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ecf0f1;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .welcome {
            text-align: center;
            margin-bottom: 40px;
        }
        .welcome h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
        .user-info {
            text-align: center;
            margin-bottom: 40px;
        }
        .user-info p {
            font-size: 1.3rem;
            color: #7f8c8d;
        }
        .menu {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .card {
            width: 18rem;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 20px;
            text-align: center;
        }
        .card-body h5 {
            font-size: 1.3rem;
            font-weight: bold;
            color: #34495e;
        }
        .card-body a {
            color: #2980b9;
            text-decoration: none;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sección de bienvenida -->
        <div class="welcome">
            <h1>Bienvenido, {{ $user->nom }} {{ $user->ap }} {{ $user->am }}!</h1>
        </div>

        <!-- Información del usuario -->
        <div class="user-info">
            <p>Tu código de usuario es: <strong>{{ $user->codigo_usuario }}</strong></p>
        </div>

        <!-- Menú provisional con tarjetas flotantes -->
        <div class="menu">
            <div class="card">
                <div class="card-body">
                    <h5>Proyectos</h5>
                    <a href="#">Ver Proyectos</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Tareas</h5>
                    <a href="#">Ver Tareas</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Configuración</h5>
                    <a href="#">Ajustes de Perfil</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Cerrar Sesión</h5>
                    <a href="#">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
