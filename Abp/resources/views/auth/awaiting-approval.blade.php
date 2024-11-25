

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodavento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <!-- Alerta basada en sesión -->
    @if(session('status'))
        <div class="alert alert-danger text-center">
            <h1 class="display-4 text-danger">Acceso Restringido</h1>
            <p class="lead">{{ session('status') }}</p>
            <p>Espera a que un administrador apruebe tu acceso.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Regresar al inicio de sesión</a>
        </div>
    @endif

    <!-- Resto del contenido -->
    <div class="alert alert-danger text-center">
        <h1 class="display-4 text-danger">Acceso Restringido</h1>
        <p class="lead">{{ session('status') }}</p>
        <p>Espera a que un administrador apruebe tu acceso.</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Regresar al inicio de sesión</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
