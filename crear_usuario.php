<?php
include 'conexion.php';

$usuario = 'cruz';
$clave_plana = 'cruz1234*';
$clave_encriptada = password_hash($clave_plana, PASSWORD_DEFAULT);

$stmt = $conexion->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $clave_encriptada);
$stmt->execute();

echo "✅ Usuario creado con éxito.";
?>
