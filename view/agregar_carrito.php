<?php
session_start();

if (!isset($_POST['producto_id']) || !isset($_POST['cantidad'])) {
    header("Location: index_incio.php");
    exit();
}

$id = intval($_POST['producto_id']);
$cantidad = max(1, intval($_POST['cantidad']));

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id] += $cantidad;
} else {
    $_SESSION['carrito'][$id] = $cantidad;
}

header("Location: carrito.php");
exit();