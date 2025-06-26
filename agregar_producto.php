<?php session_start(); 
if (!isset($_SESSION['autorizado'])) {
    $_SESSION['redirigir_a'] = 'agregar_producto.php';
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff4fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #cc1e6d;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        textarea {
            resize: none;
        }
        button {
            width: 100%;
            background-color: #cc1e6d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #a31655;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Agregar producto</h2>
        <form method="POST" action="guardar_producto.php" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre del producto" required>
            <textarea name="descripcion" placeholder="Descripción" rows="3" required></textarea>
            <input type="number" name="precio" step="0.01" placeholder="Precio" required>
            <input type="file" name="imagen" accept="image/*" required>
            <button type="submit">Guardar producto</button>
        </form>
    </div>
</body>
</html>
