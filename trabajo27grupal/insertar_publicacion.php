<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location:index.php");
  exit(0);
}
?>
<?php

include 'conexion.php';

// Insertar una nueva publicación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titulo']) && isset($_POST['contenido'])) {
    try{
        $id_usuario = $_SESSION['id']; 
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        $stmt = $pdo->prepare("INSERT INTO publicaciones (id_usuario, titulo, contenido) VALUES (?, ?, ?)");
        $stmt->execute([$id_usuario, $titulo, $contenido]);
    
        // Redireccionar a la página principal 
        header('Location: panel_de_control.php');
        exit(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }   
}
?>