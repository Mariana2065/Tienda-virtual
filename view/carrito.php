<?php include '../includes/header.php'; ?>

<div class="regresar">
  <a href=""><img src="../assets/flecha-regresar.png" alt="" class="flecha-regresar-icon"></a>
  <p>Ver más productos</p>
</div>

<div class="container contenedor-pagina-carrito">
  <div class="row fila-carrito">

    <!-- Columna izquierda productos en el carrito-->
    <div class="col-12 col-md-6 columna-carrito-izquierda">
      <div class="encabezado-carrito">
        <h2>Tu carrito</h2>
        <p class="texto-total">TOTAL (X productos) Precio</p>
      </div>

      <!-- Producto -->
      <div class="producto-carrito">
        <div class="row g-0 tarjeta-producto align-items-center">
          <div class="col-4 imagen-producto">
            <img src="../assets/icon-powerly.png" alt="Producto" class="img-fluid rounded">
          </div>
          <div class="col-8 info-producto">
            <button type="button" class="btn-close btn-eliminar"></button>
            <h5>Nombre</h5>
            <p>Precio</p>
            <select class="form-select selector-cantidad">
              <option>1</option>
              <option>2</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Producto -->
      <div class="producto-carrito">
        <div class="row g-0 tarjeta-producto align-items-center">
          <div class="col-4 imagen-producto">
            <img src="../assets/icon-powerly.png" alt="Producto" class="img-fluid rounded">
          </div>
          <div class="col-8 info-producto">
            <button type="button" class="btn-close btn-eliminar"></button>
            <h5>Nombre</h5>
            <p>Precio</p>
            <select class="form-select selector-cantidad">
              <option>1</option>
              <option>2</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Columna derecha -->
    <div class="col-12 col-md-6 columna-carrito-derecha">
      <div class="resumen-pedido">
        <h3>Resumen del pedido</h3>
        <ul class="lista-resumen">
          <li>X producto <span>$00000</span></li>
          <li>X producto <span>$00000</span></li>
        </ul>
        <hr>
        <div class="total-pedido">
          <strong>TOTAL:</strong>
          <strong>$00000</strong>
        </div>
        <button class="btn btn-resumen w-100 mt-3">Hacer pedido <span>→</span></button>
      </div>
    </div>

  </div>
</div>

<?php include '../includes/footer.php'; ?>
