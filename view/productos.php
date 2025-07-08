<?php
session_start();
require_once '../db/db.php';
include '../includes/header.php';

// Obtener todos los productos
$res = $conexion->query("SELECT * FROM productos ORDER BY id DESC");
?>

<div class="container mt-5">
  <h2 class="mb-4 text-center text-primary-emphasis">Nuestros Productos</h2>
  <div class="row justify-content-center">
    <?php while ($producto = $res->fetch_assoc()): ?>
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="card-productos h-100 shadow-lg border-0 rounded-4 producto-card">
          <img src="../assets/<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top p-3 rounded-4" alt="<?= htmlspecialchars($producto['nombre']) ?>" style="height: 250px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-primary nombre-productos-tarjetas"><?= htmlspecialchars($producto['nombre']) ?></h5>
            <p class="card-text text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
            <p class="fw-bold fs-5 text-success precio-productos-tarjetas">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
            <a href="producto.php?id=<?= $producto['id'] ?>" class="btn btn-outline-primary btn-productos mt-auto">Ver producto</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>


<?php include '../includes/footer.php'; ?>