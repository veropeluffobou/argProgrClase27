<?php
// eliminar_publicacion.php

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    try{
        $id_publicacion = $_GET['id'];
    
        // Eliminar los comentarios relacionados con la publicación
        $stmt = $pdo->prepare("DELETE FROM comentarios WHERE id_publicacion = ?");
        $stmt->execute([$id_publicacion]);

        // Eliminar la publicación
        $stmt = $pdo->prepare("DELETE FROM publicaciones WHERE id = ?");
        $stmt->execute([$id_publicacion]);
    
        // Redireccionar a la página principal 
        header('Location: panel_de_control.php');
        exit();        
            
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }      
}
?>
