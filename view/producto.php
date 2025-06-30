<?php
session_start();
require_once '../db/db.php';
include '../includes/header.php';

// Obtener ID del producto
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index_incio.php");
    exit();
}

// Obtener datos del producto
$res = $conexion->query("SELECT * FROM productos WHERE id = $id");
$producto = $res->fetch_assoc();
if (!$producto) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Producto no encontrado.</div></div>";
    include '../includes/footer.php';
    exit();
}
?>

<!---IR ATRAS PANEL-->
<div class="regresar">
    <a href="javascript:history.back()"><img src="../assets/flecha-regresar.png" alt="" class="flecha-regresar-icon"></a>
    <p>Ver más productos </p>
</div>
<div class="producto">
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="../assets/<?= htmlspecialchars($producto['imagen']) ?>" class="foto-producto img-fluid rounded-start" alt="<?= htmlspecialchars($producto['nombre']) ?>">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($producto['descripcion']) ?></p>
            <p class="card-text fw-bold fs-4">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
            <p class="card-text"><small class="text-body-secondary">Stock: <?= $producto['stock'] ?></small></p>
            
            <!-- Botón de comprar solo para usuarios cliente -->
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'cliente'): ?>
              <form method="post" action="agregar_carrito.php" class="mb-2">
                <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                <div class="mb-2">
                  <label for="cantidad" class="form-label">Cantidad:</label>
                  <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?= $producto['stock'] ?>" class="form-control" style="width:100px;display:inline-block;">
                </div>
                <button type="submit" class="btn-comprar btn btn-success">Agregar al carrito</button>
              </form>
            <?php endif; ?>

            <!-- Botones de gestión solo para admin -->
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
              <a href="editar-agregar-productos.php?id=<?= $producto['id'] ?>" class="btn btn-warning btn-sm mb-2">Editar</a>
              <a href="admin-gestionar-productos.php?eliminar=<?= $producto['id'] ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>