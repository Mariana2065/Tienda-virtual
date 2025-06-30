<?php
session_start();
require_once '../db/db.php';
include '../includes/header.php';

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Obtener productos del carrito
$carrito = $_SESSION['carrito'];
$productos_carrito = [];
$total = 0;
$total_cant = 0;

if (!empty($carrito)) {
    $ids = implode(',', array_keys($carrito));
    $res = $conexion->query("SELECT * FROM productos WHERE id IN ($ids)");
    while ($prod = $res->fetch_assoc()) {
        $prod_id = $prod['id'];
        $prod['cantidad'] = $carrito[$prod_id];
        $prod['subtotal'] = $prod['precio'] * $prod['cantidad'];
        $productos_carrito[] = $prod;
        $total += $prod['subtotal'];
        $total_cant += $prod['cantidad'];
    }
}
?>

<div class="regresar">
  <a href="index_incio.php"><img src="../assets/flecha-regresar.png" alt="" class="flecha-regresar-icon"></a>
  <p>Ver más productos</p>
</div>

<div class="container contenedor-pagina-carrito">
  <div class="row fila-carrito">

    <!-- Columna izquierda productos en el carrito-->
    <div class="col-12 col-md-6 columna-carrito-izquierda">
      <div class="encabezado-carrito">
        <h2>Tu carrito</h2>
        <p class="texto-total">TOTAL (<?= $total_cant ?> productos) $<?= number_format($total, 0, ',', '.') ?></p>
      </div>

      <?php if (empty($productos_carrito)): ?>
        <div class="alert alert-info">Tu carrito está vacío.</div>
      <?php else: ?>
        <?php foreach ($productos_carrito as $prod): ?>
          <div class="producto-carrito mb-3">
            <form method="post" action="actualizar_carrito.php" class="row g-0 tarjeta-producto align-items-center">
              <input type="hidden" name="producto_id" value="<?= $prod['id'] ?>">
              <div class="col-4 imagen-producto">
                <img src="../assets/<?= htmlspecialchars($prod['imagen']) ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>" class="img-fluid rounded">
              </div>
              <div class="col-8 info-producto">
                <button type="submit" name="eliminar" class="btn-close btn-eliminar" title="Eliminar"></button>
                <h5><?= htmlspecialchars($prod['nombre']) ?></h5>
                <p>$<?= number_format($prod['precio'], 0, ',', '.') ?></p>
                <div class="d-flex align-items-center">
                  <label class="me-2">Cantidad:</label>
                  <select name="cantidad" class="form-select selector-cantidad" style="width:80px;" onchange="this.form.submit()">
                    <?php for ($i = 1; $i <= $prod['stock']; $i++): ?>
                      <option value="<?= $i ?>" <?= $i == $prod['cantidad'] ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <div class="mt-2">
                  <strong>Subtotal: $<?= number_format($prod['subtotal'], 0, ',', '.') ?></strong>
                </div>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Columna derecha -->
    <div class="col-12 col-md-6 columna-carrito-derecha">
      <div class="resumen-pedido">
        <h3>Resumen del pedido</h3>
        <ul class="lista-resumen">
          <?php foreach ($productos_carrito as $prod): ?>
            <li><?= htmlspecialchars($prod['nombre']) ?> x<?= $prod['cantidad'] ?> <span>$<?= number_format($prod['subtotal'], 0, ',', '.') ?></span></li>
          <?php endforeach; ?>
        </ul>
        <hr>
        <div class="total-pedido">
          <strong>TOTAL:</strong>
          <strong>$<?= number_format($total, 0, ',', '.') ?></strong>
        </div>
        <?php if (!empty($productos_carrito)): ?>
          <a href="hacer_pedido.php" class="btn btn-resumen w-100 mt-3">Hacer pedido <span>→</span></a>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

<?php include '../includes/footer.php'; ?>