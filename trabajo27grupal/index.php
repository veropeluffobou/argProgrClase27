<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/minilogo.png">
    <title>Nuestro Blog</title>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Contenedor con borde (rectángulo) -->
                <div class="border p-4 rounded">
                    <!-- Contenedor flexbox para centrar la imagen vertical y horizontalmente -->
                    <div class="d-flex justify-content-center align-items-center">
                        <!-- Imagen del logotipo -->
                        <img src="images/logo.png" alt="Logo" class="img-fluid mb-3" />
                    </div>
                <h2>Iniciar Sesión</h2>
                <form id="loginForm" action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>