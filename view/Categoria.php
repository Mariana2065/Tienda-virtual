<?php
session_start();
require_once '../db/db.php';

// Obtener ID de la categoría
$categoria_id = $_GET['id'] ?? null;
if (!$categoria_id) {
    header("Location: index_incio.php");
    exit();
}

// Obtener nombre de la categoría
$res = $conexion->query("SELECT nombre FROM categorias WHERE id = $categoria_id");
$categoria = $res->fetch_assoc();

// Obtener productos de la categoría
$productos = [];
$res = $conexion->query("SELECT * FROM productos WHERE categoria_id = $categoria_id");
if ($res) {
    $productos = $res->fetch_all(MYSQLI_ASSOC);
}

include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Productos en <?= htmlspecialchars($categoria['nombre']) ?> | Powerly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>


    <!-- Offcanvas lateral-->
    <div class="offcanvas offcanvas-start menu-burguer" tabindex="-1" id="menuLateral">
        <div class="offcanvas-header ">
            <h5 class="offcanvas-title">Menú</h5>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link text-black">Mis pedidos</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white"><button class="btn-cerrar-sesion">Cerrar sesión</button></a></li>
            </ul>
        </div>
    </div>

    <!-- Nav categorias-->
    <!-- <nav class="nav-categorias">
        <ul>
            <li>Inicio</li>
            <li>Categoria</li>
            <li>Categoria</li>
            <li>Categoria</li>
            <li>Categoria</li>
        </ul>
    </nav> -->

    <!-- FILTROS Y PRODUCTOS -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- PANEL DE FILTROS -->
    
    <!-- PANEL DE PRODUCTOS -->
    <main class="col-12 col-md-9 col-lg-10">
      <h2 class="mb-4">Productos en <?= htmlspecialchars($categoria['nombre']) ?></h2>
      <div class="contenedor-productos d-flex flex-wrap gap-3">
        <?php if (empty($productos)): ?>
          <p class="text-muted">No hay productos en esta categoría.</p>
        <?php else: ?>
          <?php foreach ($productos as $prod): ?>
            <div class="card" style="width: 18rem;">
              <img src="../assets/<?= htmlspecialchars($prod['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($prod['nombre']) ?>">
              <div class="card-body text-center">
                <p class="card-text fw-bold">$<?= number_format($prod['precio'], 0, ',', '.') ?></p>
                <p class="card-text"><?= htmlspecialchars($prod['nombre']) ?></p>
                <p class="card-text"><?= htmlspecialchars($prod['descripcion']) ?></p>
                <a href="producto.php?id=<?= $prod['id'] ?>" class="btn btn-primary btn-sm mb-2">Ver producto</a>
                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
                  <a href="editar-agregar-productos.php?id=<?= $prod['id'] ?>" class="btn btn-warning btn-sm mb-2">Editar</a>
                  <a href="admin-gestionar-productos.php?eliminar=<?= $prod['id'] ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </main>
  </div>
</div>
<?php include '../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>