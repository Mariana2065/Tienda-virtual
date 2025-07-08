<?php
session_start();

require_once '../db/db.php';

// Obtener productos
$productos = [];
$res = $conexion->query("SELECT id, nombre, descripcion, precio, imagen FROM productos ORDER BY id DESC");
if ($res) {
    $productos = $res->fetch_all(MYSQLI_ASSOC);
}
?>

<!-- principal -->
<section class="contenedor-imagen-index">
  <div class="container contenedor-texto-hero">
    <div class="caja-texto-izquierda">
      <h1 class="titulo-index">Bienvenido a <span class="powerly">POWERLY</span></h1>
      <h2 class="subtitulo-index">Activa tu poder. Viste con energía.</h2>
      <p class="descripcion-index">Descubre ropa deportiva diseñada para tu mejor versión.</p>
    </div>
  </div>
</section>

<section class="frase-destacada">
  <div class="container text-center">
    <h2 class="titulo-frase">Más que ropa deportiva…</h2>
    <p class="texto-frase">
      En <span class="marca">POWERLY</span> te acompañamos a romper tus límites con estilo, comodidad y actitud.
    </p>
  </div>
</section>

<!-- Productos destacados -->
<section id="productos" class="seccion-productos-index">
  <div class="container">
    <h2 class="text-center mb-5">Productos destacados</h2>
    <div class="row justify-content-center g-4">
      <?php foreach ($productos as $prod): ?>
        <div class="col-md-4 mb-4">
          <div class="card-index">
            <img src="../assets/<?= (htmlspecialchars($prod['imagen']) && file_exists("../assets/" . $prod['imagen'])) ? htmlspecialchars($prod['imagen']) : 'no-image.png' ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>" class="card-img-top" style="height:180px;object-fit:cover;">
            <div class="card-body text-center">
              <h5 class="card-title"><?= htmlspecialchars($prod['nombre']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($prod['descripcion']) ?></p>
              <p class="card-text fw-bold">$<?= number_format($prod['precio'], 0, ',', '.') ?></p>
              <a href="../view/producto.php?id=<?= $prod['id'] ?>" class="btn btn-primary btn-sm">Ver producto</a>
              <?php if (!isset($_SESSION['usuario'])): ?>
                <p class="text-muted">Inicia sesión para realizar compras.</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-4">
      <a href="../view/productos.php" class="btn btn-explorar-productos">Explorar todos los productos</a>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>