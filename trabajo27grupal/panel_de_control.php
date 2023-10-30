<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location:index.php");
  exit(0);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">    
    <title>Nuestro Blog</title>
    <link rel="shortcut icon" href="images/minilogo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
        <div class="container">
            <a class="navbar-brand" href="#">Nuestro Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nosotras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>   
                <button type="button" class="btn btn-dark ml-auto mr-2" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    Cerrar Sesión
                </button>                                       
            </div>
        </div>
    </nav>

    <!-- Modal de Cierre de Sesión -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Cerrar Sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro de que desea cerrar la sesión?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="logout.php" class="btn btn-primary">Cerrar Sesión</a>
      </div>
    </div>
  </div>
</div>


<div class = "container">
<h2>El BLOG 4 CHICAS</h2>


<!-- Formulario para crear una nueva publicación -->
    <div class="container mt-5">
    <H3>Ingrese una nueva publicación</H3>
        <form action = "insertar_publicacion.php" method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido:</label>
                <textarea class="form-control" id="contenido" name="contenido" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
    </div>
    <div>
    <hr>
    <h2>Publicaciones</h2>
    <hr>


<?php

include 'conexion.php';

// Listar las publicaciones y sus comentarios
$stmt = $pdo->query("SELECT publicaciones.*, usuarios.nombre as nombre_usuario, COUNT(comentarios.id) as cantidad_comentarios 
                    FROM publicaciones 
                    LEFT JOIN usuarios ON publicaciones.id_usuario = usuarios.id 
                    LEFT JOIN comentarios ON publicaciones.id = comentarios.id_publicacion 
                    GROUP BY publicaciones.id 
                    ORDER BY fecha_publicacion DESC");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div style='border:1px solid black;padding:2rem;border-radius: 1rem'>";
    echo "<h3>Título: {$row['titulo']}</h3>";
    echo "<p>Publicado por: {$row['nombre_usuario']} el {$row['fecha_publicacion']}.</p>";
    echo "<p>Contenido: {$row['contenido']}</p>";
    echo "<a href='eliminar_publicacion.php?id={$row['id']}' class='btn btn-danger'>Eliminar Publicación y sus comentarios</a>";    
    echo "<p>Cantidad de Comentarios: {$row['cantidad_comentarios']}</p>";
    

    // Listar comentarios para esta publicación
    $stmt2 = $pdo->prepare("SELECT comentarios.*, usuarios.nombre as nombre_usuario 
                            FROM comentarios 
                            LEFT JOIN usuarios ON comentarios.id_usuario = usuarios.id 
                            WHERE id_publicacion = ?");
    $stmt2->execute([$row['id']]);

    while ($comment = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        echo '<h4> Comentarios </h4>';
        echo "<p>Por {$comment['nombre_usuario']} el {$comment['fecha_comentario']}:</p>";
        echo "<p>{$comment['contenido']}</p>";
        echo '<a href="eliminar_comentario.php?id=' . $comment['id'] . '" class="btn btn-danger">Eliminar Comentario</a>';

    }
    
    // Formulario para agregar comentarios
    echo '<form action = "insertar_comentario.php" method="POST">';
    echo '<input type="hidden" name="id_publicacion" value="' . $row['id'] . '">';
    echo '<div class="mb-3">';
    echo '<label for="comentario" class="form-label">Agregar un comentario:</label>';
    echo '<textarea class="form-control" name="comentario" required></textarea>';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Comentar</button>';
    echo '</form>';
    echo '</div>';
    echo '<br>';
}
?>
</div>

<br><br><br><br>

</div>
    <!-- Footer -->   
    <footer class="footer bg-dark text-white mt-5 footer-fixed">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?>-- Verónica - Silvia - Amalia - Mariana -- Todos los derechos reservados.</p>
        </div>
    </footer> 
      <!-- End of Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
