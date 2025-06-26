<?php include '../includes/header.php'; ?>

<main class="contenedor-tabla-gestion container mt-5">
  <h2 class="text-center mb-4 titulo-gestionar-productos">GESTION DE PRODUCTOS</h2>

  <div class="mb-3">
    <button class="btn btn-crear-gestionar-productos">Crear producto</button>
  </div>

  <table class="table table-bordered text-center tabla-gestionar-productos">
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>NOMBRE</td>
        <td>PRECIO</td>
        <td>2</td>
        <td>
          <button class="btn btn-editar-gestionar-productos me-2">Editar</button>
          <button class="btn btn-eliminar-gestionar-productos">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</main>

<?php include '../includes/footer.php'; ?>
