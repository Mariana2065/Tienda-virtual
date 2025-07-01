<?php
session_start();
require_once '../db/db.php';
include '../includes/header.php';

// Obtener todos los productos
$res = $conexion->query("SELECT * FROM productos ORDER BY id DESC");
?>

<div class="container mt-5">
    <h2 class="mb-4">Todos los productos</h2>
    <div class="row">
        <?php while ($producto = $res->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="../assets/<?= htmlspecialchars($producto['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($producto['descripcion']) ?></p>
                        <p class="card-text fw-bold">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
                        <a href="producto.php?id=<?= $producto['id'] ?>" class="btn btn-primary">Ver producto</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>