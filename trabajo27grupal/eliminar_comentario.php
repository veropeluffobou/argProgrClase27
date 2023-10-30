<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location:index.php");
  exit(0);
}
?>
<?php
// eliminar_comentario.php

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    try{
        $comentario_id = $_GET['id'];

        // Asegúrate de que el usuario tenga permisos para eliminar el comentario (puedes verificar esto en tu lógica de autenticación).

        // Elimina el comentario de la base de datos
        $stmt = $pdo->prepare("DELETE FROM comentarios WHERE id = ?");
        $stmt->execute([$comentario_id]);

        // Redireccionar a la página principal 
        header('Location: panel_de_control.php');
        exit(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }   
}
?>