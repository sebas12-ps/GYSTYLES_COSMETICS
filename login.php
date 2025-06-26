<?php
session_start();
include 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();

        if (password_verify($clave, $fila['contraseña'])) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['autorizado'] = true;

            $destino = isset($_SESSION['redirigir_a']) ? $_SESSION['redirigir_a'] : 'agregar_producto.php';
            unset($_SESSION['redirigir_a']);
            header("Location: $destino");
            exit;
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fbe4ef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            color: #cc1e6d;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        button {
            width: 95%;
            padding: 10px;
            background-color: #cc1e6d;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background-color: #a31655;
        }
        .mensaje {
            margin: 10px 0;
            color: red;
        }
        .success {
            color: green;
        }
        .regresar {
            display: inline-block;
            margin-top: 15px;
            color: #cc1e6d;
            text-decoration: none;
        }
        .regresar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>

        <?php if ($mensaje): ?>
            <div class="mensaje"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'guardado'): ?>
            <div class="mensaje success">Producto guardado correctamente. Inicia sesión nuevamente.</div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required><br>
            <input type="password" name="clave" placeholder="Contraseña" required><br>
            <button type="submit">Ingresar</button>
        </form>

        <a href="index.php" class="regresar">← Regresar a la página principal</a>
    </div>
</body>
</html>
