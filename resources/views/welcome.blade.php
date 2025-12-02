<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pasajeras Azteca de Oro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <h1>Azteca de Oro</h1>
                <p>Sistema de Pasajeras</p>
            </div>

            <!-- Formulario que envía a Laravel -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Usuario" value="{{ old('username') }}" required autofocus>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>

                <div class="options">
                    <div class="remember">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Recordarme</label>
                    </div>
                    <div class="forgot">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

                <!-- Mensajes de error (si falla el login) -->
                @if($errors->any())
                    <div class="alert alert-danger" style="margin: 15px 0; padding: 12px; border-radius: 8px; font-size: 14px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Mensaje de éxito (por ejemplo, cierre de sesión) -->
                @if(session('success'))
                    <div class="alert alert-success" style="margin: 15px 0; padding: 12px; border-radius: 8px; font-size: 14px;">
                        {{ session('success') }}
                    </div>
                @endif

                <button type="submit" class="btn">Iniciar Sesión</button>

                <div class="register">
                    ¿No tienes una cuenta? <a href="#">Contáctanos</a>
                </div>
            </form>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Azteca de Oro. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>