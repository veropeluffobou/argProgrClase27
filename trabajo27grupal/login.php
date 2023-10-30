<?php
/*
session_start(); // Inicia la sesión 

include 'conexion.php';
include 'Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = $_POST["email"];
        $password = $_POST["password"];  

        // Consulta para verificar las credenciales del usuario
        $consulta = "SELECT id, nombre, email, password FROM usuarios WHERE email = ? AND password = ?";
        $stmt = $pdo->prepare($consulta);
        $stmt->execute([$email, $password]);
        $row = $stmt->fetch();

        if ($row) {
            // Crear un objeto Usuario con los datos de la base de datos
            $usuario = new Usuario($row['id'], $row['nombre'], $row['email'], $row['password']);

            // Almacenar el objeto Usuario en la sesión
            $_SESSION["usuario"] = $usuario;

            // Redireccionar al panel de control u otra página de inicio
            header("Location: panel_de_control.php");
            exit();
        } else {
            echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
*/

?>




<?php
session_start(); // Inicia la sesión

include 'conexion.php';
include 'Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Consulta para verificar las credenciales del usuario
        $consulta = "SELECT id, nombre, email, password FROM usuarios WHERE email = ? AND password = ?";
        $stmt = $pdo->prepare($consulta);
        $stmt->execute([$email, $password]);
        $row = $stmt->fetch();

        if ($row) {
            // Crear un objeto Usuario con los datos de la base de datos
            $usuario = new Usuario($row['id'], $row['nombre'], $row['email'], $row['password']);

            // Almacenar el objeto Usuario en la sesión
            $_SESSION["usuario"] = $usuario;
            $_SESSION["id"] = $row['id'];
            $_SESSION["nombre"] = $row['nombre'];


            // Redireccionar al panel de control u otra página de inicio
            header("Location: panel_de_control.php");
            exit();
        } else {
            echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
