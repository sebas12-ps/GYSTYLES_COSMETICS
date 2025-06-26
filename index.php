<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>GISTYLES COSMETICS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>GISTYLES COSMETICS</h1>
</a>


    <?php
$totalCantidad = 0;
if (!empty($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $detalle) {
        $totalCantidad += $detalle['cantidad'];
    }
}
?>

<!-- 🛒 Ícono del carrito -->
<a href="ver_carrito.php" class="carrito-icono">
    🛒 Carrito (<?php echo $totalCantidad; ?>)
</a>

<div id="carrito" class="carrito-contenido">
    <h2>🛒 Carrito de compras</h2>
    <?php if (!empty($_SESSION['carrito'])): ?>
        <ul>
            <?php
            $total = 0;
            foreach ($_SESSION['carrito'] as $producto => $detalle) {
                $subtotal = $detalle['precio'] * $detalle['cantidad'];
                echo "<li><strong>$producto</strong> - Cantidad: {$detalle['cantidad']} - Subtotal: \$" . number_format($subtotal, 2) . "</li>";
                $total += $subtotal;
            }
            ?>
        </ul>
        <p><strong>Total: $<?php echo number_format($total, 2); ?></strong></p>
    <?php else: ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>
</div>


    <div class="productos">
    <?php
include 'conexion.php';

$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);

while ($producto = $resultado->fetch_assoc()) {
    echo "<div class='producto'>";
    echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}'>";
    echo "<h2>{$producto['nombre']}</h2>";
    echo "<p>{$producto['descripcion']}</p>";
    echo "<p class='precio'>\$" . number_format($producto['precio'], 2) . "</p>";
    echo "<form method='POST' action='carrito.php'>";
    echo "<input type='hidden' name='producto' value='{$producto['nombre']}'>";
    echo "<input type='hidden' name='precio' value='{$producto['precio']}'>";
    echo "<button type='submit'>Agregar al carrito</button>";
    echo "</form>";
    echo "</div>";
}
?>

    </div>
    <script>
    // El carrito se abre/cierra con toggle, manejado arriba con onclick
</script>
<a href="agregar_producto.php" class="boton-agregar-flotante">
    ➕ Agregar
</a>


</body>
</html>

