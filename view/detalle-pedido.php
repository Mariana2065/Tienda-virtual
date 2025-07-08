<?php
session_start();
require_once '../db/db.php';
include '../includes/header.php';

// Validar que venga el ID del pedido
if (!isset($_GET['id'])) {
    echo "<p>Error: No se especificó el pedido.</p>";
    include '../includes/footer.php';
    exit;
}

$id_pedido = intval($_GET['id']);

// Obtener datos generales del pedido
$sqlPedido = "SELECT id, total, fecha, hora FROM pedidos WHERE id = ?";
$stmtPedido = $conexion->prepare($sqlPedido);
$stmtPedido->bind_param("i", $id_pedido);
$stmtPedido->execute();
$resultPedido = $stmtPedido->get_result();
$pedido = $resultPedido->fetch_assoc();

if (!$pedido) {
    echo "<p>Pedido no encontrado.</p>";
    include '../includes/footer.php';
    exit;
}

// Obtener productos del pedido
$sqlDetalles = "SELECT lp.unidades, p.nombre, p.precio, p.imagen 
                FROM lineas_pedidos lp
                INNER JOIN productos p ON lp.producto_id = p.id
                WHERE lp.pedido_id = ?";
$stmtDetalles = $conexion->prepare($sqlDetalles);
$stmtDetalles->bind_param("i", $id_pedido);
$stmtDetalles->execute();
$resultDetalles = $stmtDetalles->get_result();
$productos = $resultDetalles->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
    <h1 class="text-center my-4">PEDIDO CONFIRMADO</h1>
    <p><strong>Número de pedido:</strong> <?php echo $pedido['id']; ?></p>
    <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?> - <strong>Hora:</strong> <?php echo $pedido['hora']; ?></p>
    <p><strong>Total a pagar:</strong> $<?php echo number_format($pedido['total'], 0, ',', '.'); ?></p>
    <p>Gracias por tu compra. Realiza la transferencia del total a la cuenta bancaria indicada y tu pedido será procesado.</p>
    <hr>

    <?php foreach ($productos as $producto): ?>
        <div class="producto-confirmacion mb-3">
            <div class="row">
                <div class="col-md-3">
                    <img src="../assets/<?php echo htmlspecialchars($producto['imagen']); ?>" class="img-fluid">
                </div>
                <div class="col-md-9">
                    <p><strong>Producto:</strong> <?php echo htmlspecialchars($producto['nombre']); ?></p>
                    <p><strong>Precio unitario:</strong> $<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>
                    <p><strong>Cantidad:</strong> <?php echo $producto['unidades']; ?></p>
                    <p><strong>Subtotal:</strong> $<?php echo number_format($producto['precio'] * $producto['unidades'], 0, ',', '.'); ?></p>
                </div>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>
