<?php 
session_start();
include 'conexion.php'; // Asegúrate de tener una función conectar() en este archivo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Subir imagen
    $imagen = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $rutaDestino = 'imagenes/' . $imagen;

    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        // Conectar a la base de datos
        //$conexion = conectar(); 🔧 aquí estaba el error

        $stmt = $conexion->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $rutaDestino);
        $stmt->execute();

        $stmt->close();
        $conexion->close();

        // ✅ Cerrar sesión y redirigir al login
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        echo "Error al subir la imagen.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
