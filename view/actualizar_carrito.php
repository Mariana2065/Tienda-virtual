<?php
session_start();

if (!isset($_POST['producto_id'])) {
    header("Location: carrito.php");
    exit();
}

$id = $_POST['producto_id'];

if (isset($_POST['eliminar'])) {
    unset($_SESSION['carrito'][$id]);
} elseif (isset($_POST['cantidad'])) {
    $cantidad = max(1, intval($_POST['cantidad']));
    $_SESSION['carrito'][$id] = $cantidad;
}

header("Location: carrito.php");
exit();