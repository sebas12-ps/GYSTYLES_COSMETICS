<?php
session_start();

if (isset($_GET['producto'])) {
    $producto = $_GET['producto'];
    if (isset($_SESSION['carrito'][$producto])) {
        unset($_SESSION['carrito'][$producto]);
    }
}

header("Location: ver_carrito.php");
exit;
