<?php
session_start();
require_once '../db/db.php';
include '../includes/header.php';

// Obtener todos los productos
$res = $conexion->query("SELECT * FROM productos ORDER BY id DESC");
// paginación 
$productosPorPagina = 3;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($paginaActual < 1) $paginaActual = 1;

$offset = ($paginaActual - 1) * $productosPorPagina;

$totalProductos = $conexion->query("SELECT COUNT(*) as total FROM productos")->fetch_assoc()['total'];
$totalPaginas = ceil($totalProductos / $productosPorPagina);

$res = $conexion->query("SELECT * FROM productos ORDER BY id DESC LIMIT $productosPorPagina OFFSET $offset");

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
<div class="mt-4 d-flex justify-content-center">
  <nav>
    <ul class="pagination">
      <?php if ($paginaActual > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?pagina=<?= $paginaActual - 1 ?>">Anterior</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?>">
          <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($paginaActual < $totalPaginas): ?>
        <li class="page-item">
          <a class="page-link" href="?pagina=<?= $paginaActual + 1 ?>">Siguiente</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>




<?php include '../includes/footer.php'; ?>