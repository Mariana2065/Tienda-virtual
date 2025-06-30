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
    <aside class="col-12 col-md-4 col-lg-2 mb-3">
      <div class="contenedor-filtros">
        <div class="contenedor-btn-filtros">
          <!--Filtro de ordenar-->
          <div class="dropdown">
            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ordenar
            </button>
            <ul class="dropdown-menu p-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="orden" id="mayor" value="mayor">
                <label class="form-check-label" for="mayor">De mayor a menor</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="orden" id="menor" value="menor">
                <label class="form-check-label" for="menor">De menor a mayor</label>
              </div>
            </ul>
          </div>
          <!--Género-->
          <div class="dropdown">
            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Género
            </button>
            <ul class="dropdown-menu p-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="mujer" value="mujer">
                <label class="form-check-label" for="mujer">Mujer</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="hombre" value="hombre">
                <label class="form-check-label" for="hombre">Hombre</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" id="Unisex" value="Unisex">
                <label class="form-check-label" for="Unisex">Unisex</label>
              </div>
            </ul>
          </div>
          <!--Deporte-->
          <div class="dropdown">
            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Deporte
            </button>
            <ul class="dropdown-menu p-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="deporte" id="golf" value="golf">
                <label class="form-check-label" for="golf">Golf</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="deporte" id="box" value="box">
                <label class="form-check-label" for="box">Box</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="deporte" id="tenis" value="tenis">
                <label class="form-check-label" for="tenis">Tenis</label>
              </div>
            </ul>
          </div>
          <!--Marca-->
          <div class="dropdown">
            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Marca
            </button>
            <ul class="dropdown-menu p-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="marca" id="marca1" value="marca1">
                <label class="form-check-label" for="marca1">Marca 1</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="marca" id="marca2" value="marca2">
                <label class="form-check-label" for="marca2">Marca 2</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="marca" id="marca3" value="marca3">
                <label class="form-check-label" for="marca3">Marca 3</label>
              </div>
            </ul>
          </div>
        </div>
      </div>
    </aside>
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