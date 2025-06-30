<?php
session_start();
require_once '../db/db.php';

// Solo usuarios logueados pueden hacer pedidos
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Verifica que el carrito no esté vacío
if (empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];
$carrito = $_SESSION['carrito'];

// Calcular total
$total = 0;
$ids = implode(',', array_keys($carrito));
$res = $conexion->query("SELECT id, precio FROM productos WHERE id IN ($ids)");
while ($prod = $res->fetch_assoc()) {
    $prod_id = $prod['id'];
    $cantidad = $carrito[$prod_id];
    $total += $prod['precio'] * $cantidad;
}

// Insertar pedido
$estado = 'pendiente';
$fecha = date('Y-m-d');
$stmt = $conexion->prepare("INSERT INTO pedidos (usuario_id, total, estado, fecha) VALUES (?, ?, ?, ?)");
$stmt->bind_param("idss", $usuario_id, $total, $estado, $fecha);
$stmt->execute();
$pedido_id = $stmt->insert_id;

// (Opcional) Aquí puedes guardar los productos del pedido en otra tabla, si tienes una tabla detalle_pedidos

// Limpiar carrito
unset($_SESSION['carrito']);

// Redirigir al historial de pedidos
header("Location: pedidos-usuarios.php");
exit();