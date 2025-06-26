<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras - GISTYLES</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #fff0f5;
        }

        .carrito {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-volver, .btn-eliminar {
            display: inline-block;
            background: #d63384;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-volver:hover, .btn-eliminar:hover {
            background: #c2185b;
        }

        .total {
            font-weight: bold;
            margin-top: 20px;
        }

        .btn-whatsapp {
            display: block;
            width: 100%;
            margin-top: 20px;
            text-align: center;
            background-color: #25D366;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-whatsapp:hover {
            background-color: #1ebe5d;
        }
    </style>
</head>
<body>

<div class="carrito">
    <h1>🛒 Carrito de compras</h1>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <ul>
            <?php
            $total = 0;
            $mensaje = "¡Hola! Me gustaría comprar los siguientes productos:\n";
            foreach ($_SESSION['carrito'] as $producto => $detalle):
                $subtotal = $detalle['precio'] * $detalle['cantidad'];
                $total += $subtotal;

                $mensaje .= "- " . $producto . " x" . $detalle['cantidad'] . " ($" . number_format($subtotal, 2) . ")\n";
            ?>
                <li>
                    <span><strong><?php echo $producto; ?></strong> - Cantidad: <?php echo $detalle['cantidad']; ?> - Subtotal: <?php echo number_format($subtotal, 2); ?></span>
                    <a class="btn-eliminar" href="eliminar_producto.php?producto=<?php echo urlencode($producto); ?>">Eliminar</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="total">Total a pagar: <?php echo number_format($total, 2); ?></p>

        <?php
        $mensaje .= "Total: $" . number_format($total, 2);
        $telefono = "573166073611"; // ← Reemplaza este número con tu número de WhatsApp
        $url = "https://wa.me/$telefono?text=" . urlencode($mensaje);
        ?>

        <a href="<?php echo $url; ?>" class="btn-whatsapp" target="_blank">🟢 Comprar por WhatsApp</a>
    <?php else: ?>
        <p>El carrito está vacío.</p>
    <?php endif; ?>

    <a href="index.php" class="btn-volver">← Volver a la tienda</a>
</div>

</body>
</html>
