<?php include '../includes/header.php'; ?>

<main class="contenedor-tabla-gestion-categorias container mt-5">
  <h2 class="text-center mb-4 titulo-gestionar-categorias">GESTION DE CATEGORIAS</h2>

  <table class="table table-bordered text-center tabla-gestionar-categorias">
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Nombre</td>
        <td>
          <button class="btn btn-editar-gestionar-categorias me-2">Editar</button>
          <button class="btn btn-eliminar-gestionar-categorias">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
</main>

<?php include '../includes/footer.php'; ?>
