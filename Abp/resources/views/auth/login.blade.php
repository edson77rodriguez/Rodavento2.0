<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="contenedor__todo">
    <div class="caja__trasera">
        <div class="caja__trasera-login">
            <h3>¿Ya tienes una cuenta?</h3>
            <p>Inicia sesión para entrar en la página</p>
            <button id="btn__iniciar-sesion" class="btn btn-primary">Iniciar Sesión</button>
        </div>
        <div class="caja__trasera-register">
            <h3>¿Aún no tienes una cuenta?</h3>
            <p>Regístrate para que puedas iniciar sesión</p>
            <button id="btn__registrarse" class="btn btn-secondary">Regístrarse</button>
        </div>
    </div>

    <div class="contenedor__login-register">
        <form method="POST" action="{{ route('login') }}" class="formulario__login">
            @csrf
            <h2>Iniciar Sesión</h2>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Correo Electrónico" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
        </form>
    </div>
</div>
@endsection
