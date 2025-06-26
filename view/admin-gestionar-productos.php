<?php include '../includes/header.php'; ?>
<?php
require_once '../db/db.php';

// Obtener productos de la base de datos
$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);
?>

<main class="contenedor-tabla-gestion container mt-5">
  <h2 class="text-center mb-4 titulo-gestionar-productos">GESTION DE PRODUCTOS</h2>

  <div class="mb-3">
    <a href="editar-agregar-productos.php" class="btn btn-crear-gestionar-productos">Crear producto</a>
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
      <?php while ($prod = $resultado->fetch_assoc()): ?>
      <tr>
        <td><?php echo $prod['id']; ?></td>
        <td><?php echo htmlspecialchars($prod['nombre']); ?></td>
        <td><?php echo $prod['precio']; ?></td>
        <td><?php echo $prod['stock']; ?></td>
        <td>
          <a href="editar-agregar-productos.php?id=<?php echo $prod['id']; ?>" class="btn btn-editar-gestionar-productos me-2">Editar</a>
          <a href="eliminar-producto.php?id=<?php echo $prod['id']; ?>" class="btn btn-eliminar-gestionar-productos" onclick="return confirm('¿Seguro que deseas eliminar este producto?');">Eliminar</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>

<?php include '../includes/footer.php'; ?>