<?php include '../includes/header.php'; 
require_once '../db/db.php';
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

<!-- Categorías y un producto destacado por categoría -->
<section id="categorias" class="seccion-categorias-index">
  <div class="container">
    <h2 class="text-center mb-5">Categorías destacadas</h2>
    <?php foreach ($categorias as $cat): ?>
      <div class="mb-5">
       <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
  <img src="../assets/icon-powerly.png" alt="<?= htmlspecialchars($cat['nombre']) ?>" style="width:40px;height:40px;object-fit:cover;">
  <h3 class="mb-0"><?= htmlspecialchars($cat['nombre']) ?></h3>
  <a href="Categoria.php?id=<?= $cat['id'] ?>" class="btn btn-outline-primary btn-sm">Ver todo</a>
</div>

        <div class="row justify-content-center g-4">
          <?php
          $prod = $productos_por_categoria[$cat['id']]['producto'];
          if (!$prod):
          ?>
            <div class="col-12">
              <p class="text-muted text-center">No hay productos en esta categoría.</p>
            </div>
          <?php
          else:
          ?>
            <div class="col-md-4 mb-4">
              <div class="card-index">
                <img src="../assets/<?= htmlspecialchars($prod['imagen']) && file_exists("../assets/" . $prod['imagen']) ? htmlspecialchars($prod['imagen']) : 'no-image.png' ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>" class="card-img-top" style="height:180px;object-fit:cover;">
                <div class="card-body text-center">
                  <h5 class="card-title"><?= htmlspecialchars($prod['nombre']) ?></h5>
                  <p class="card-text"><?= htmlspecialchars($prod['descripcion']) ?></p>
                  <p class="card-text fw-bold">$<?= number_format($prod['precio'], 0, ',', '.') ?></p>
                  <a href="producto.php?id=<?= $prod['id'] ?>" class="btn btn-primary btn-sm">Ver producto</a>
                  <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
                    <a href="editar-agregar-productos.php?id=<?= $prod['id'] ?>" class="btn btn-warning btn-sm ms-2">Editar</a>
                    <a href="admin-gestionar-productos.php?eliminar=<?= $prod['id'] ?>" class="btn btn-danger btn-sm ms-2" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="text-center mt-4">
      <a href="productos.php" class="btn btn-explorar-productos">Explorar todos los productos</a>
    </div>
  </div>
</section>
<?php include '../includes/footer.php'; ?>