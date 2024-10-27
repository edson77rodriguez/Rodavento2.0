<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
    <main>
        <div class="contenedor__todo">
            <div class="contenedor__login-register">
                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}" class="formulario__register">
                    @csrf
                    <h2>Registro de Usuario</h2>

                    <div class="form-group">
                        <label for="nom">Nombre:</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="ap">Apellido Paterno:</label>
                        <input type="text" name="ap" id="ap" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="am">Apellido Materno:</label>
                        <input type="text" name="am" id="am" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion_id">Dirección:</label>
                        <select name="direccion_id" id="direccion_id" class="form-control" required>
                            <option value="">Selecciona una dirección</option>
                            @foreach ($direccions as $direccion)
                                <option value="{{ $direccion->id }}">{{ $direccion->desc_direccion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="rol_id">Rol:</label>
                        <select name="rol_id" id="rol_id" class="form-control" required>
                            <option value="">Selecciona un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nom_rol }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/script.js') }}"></script>
@endsection
