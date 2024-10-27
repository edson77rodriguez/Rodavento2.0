<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app2')

@section('title', 'Iniciar Sesión')

@section('content')
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion" class="btn btn-primary" onclick="document.querySelector('.formulario__login').style.display='block'; document.querySelector('.formulario__register').style.display='none';">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse" class="btn btn-secondary" onclick="document.querySelector('.formulario__register').style.display='block'; document.querySelector('.formulario__login').style.display='none';">Registrarse</button>
                </div>
            </div>

            <div class="contenedor__login-register">
                <!-- Login -->
                <form method="POST" action="{{ route('login') }}" class="formulario__login">
                    @csrf
                    <h2>Iniciar Sesión</h2>
                    <input type="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autofocus class="@error('email') is-invalid @enderror">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="password" placeholder="Contraseña" name="password" required class="@error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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

                    <select name="direccion_id" id="direccion_id" required>
                        <option>Selecciona una dirección</option>
                        @foreach ($direccions as $direccion)
                            <option value="{{ $direccion->id }}">{{ $direccion->desc_direccion }}</option>
                        @endforeach
                    </select>

                    <select name="rol_id" id="rol_id" required>
                        <option>Selecciona un rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nom_rol }}</option>
                        @endforeach
                    </select>

                    <input type="password" placeholder="Contraseña" name="password" id="password" required>
                    <input type="password" placeholder="Confirmar Contraseña" name="password_confirmation" id="password_confirmation" required>

                    <button type="submit">Registrar</button>
                </form>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/script.js') }}"></script>
@endsection
