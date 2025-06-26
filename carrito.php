<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si ya existe el producto en el carrito, aumentar la cantidad
    if (isset($_SESSION['carrito'][$producto])) {
        $_SESSION['carrito'][$producto]['cantidad'] += 1;
    } else {
        $_SESSION['carrito'][$producto] = [
            'precio' => $precio,
            'cantidad' => 1
        ];
    }
}

header('Location: index.php');
exit;
