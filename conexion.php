<?php
// function conectar() {
$host = "localhost";
$usuario = "root"; // Cambia si tienes otro usuario
$contrasena = "";  // Cambia si tienes contraseña
$bd = "tienda";

$conexion = new mysqli($host, $usuario, $contrasena, $bd);

    if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
    }
//}
?>
