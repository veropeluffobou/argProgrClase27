<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location:index.php");
  exit(0);
}
?>
<?php
include 'conexion.php';

// Procesar el formulario de comentarios
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario']) && isset($_POST['id_publicacion'])) {
    try{
        $id_usuario = $_SESSION['id']; 
        $id_publicacion = $_POST['id_publicacion'];
        $comentario = $_POST['comentario'];

        $stmt = $pdo->prepare("INSERT INTO comentarios (id_usuario, id_publicacion, contenido) VALUES (?, ?, ?)");
        $stmt->execute([$id_usuario, $id_publicacion, $comentario]);

        // Redireccionar a la página principal 
        header('Location: panel_de_control.php');
        exit(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }   
}
?>