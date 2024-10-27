<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/estilos.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login')) @endif
                        @if (Route::has('register')) @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!-- Formulario de Login y Registro -->
            <div class="contenedor__login-register">
                <!-- Login -->
                <form method="POST" action="{{ route('login') }}" class="formulario__login">
                    @csrf
                    <h2>Iniciar Sesión</h2>
                    <input type="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autofocus>
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <button type="submit">Entrar</button>
                </form>

                <!-- Register -->
                <form method="POST" action="{{ route('register') }}" class="formulario__register">
                    @csrf
                    <h2>Registrarse</h2>

                    <input type="text" placeholder="Nombre" name="nom" id="nom" value="{{ old('nom') }}" required>
                    <input type="text" placeholder="Apellido Paterno" name="ap" id="ap" value="{{ old('ap') }}" required>
                    <input type="text" placeholder="Apellido Materno" name="am" id="am" value="{{ old('am') }}" required>
                    <input type="email" placeholder="Correo Electrónico" name="email" id="email" value="{{ old('email') }}" required>
                    <input type="text" placeholder="Teléfono" name="telefono" id="telefono" value="{{ old('telefono') }}" required>

                    <div class="select-container">
                        <select class="selected" name="direccion_id" id="direccion_id" required>
                            <option>Selecciona una dirección</option>
                            @foreach ($direccions as $direccion)
                                <option value="{{ $direccion->id }}">{{ $direccion->desc_direccion }}</option>
                            @endforeach
                        </select>

                        <select class="selected" name="rol_id" id="rol_id" required>
                            <option>Selecciona un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nom_rol }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="password" placeholder="Contraseña" name="password" id="password" required>
                    <input type="password" placeholder="Confirmar Contraseña" name="password_confirmation" id="password_confirmation" required>

                    <button type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </main>
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
