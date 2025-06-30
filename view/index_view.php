<?php
session_start();
require_once '../db/db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); 
    exit();
}

// Obtener productos
$productos = [];
$res = $conexion->query("SELECT * FROM productos");
if ($res) {
    $productos = $res->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tienda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

  <h1 class="mb-4">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?> 👋</h1>
  <h2>Catálogo de productos</h2>
  <div class="row">
    <?php foreach ($productos as $prod): ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($prod['nombre']) ?></h5>
            <p class="card-text">Precio: $<?= $prod['precio'] ?></p>
            <p class="card-text">Stock: <?= $prod['stock'] ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>
</body>
</html>