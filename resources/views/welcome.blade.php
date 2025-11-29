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
            <form id="loginForm">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" placeholder="Usuario" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" placeholder="Contraseña" required>
                </div>
                <div class="options">
                    <div class="remember">
                        <input type="checkbox" id="remember">
                        <label for="remember">Recordarme</label>
                    </div>
                    <div class="forgot">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                <button type="submit" class="btn">Iniciar Sesión</button>
                <div class="register">
                    ¿No tienes una cuenta? <a href="#">Regístrate</a>
                </div>
            </form>
            <div class="footer">
                <p>&copy; 2023 Azteca de Oro. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí irá la validación con Laravel/MySQL en el futuro
            alert('En el futuro, aquí se validarán las credenciales con Laravel y MySQL');
        });
    </script>
</body>
</html>