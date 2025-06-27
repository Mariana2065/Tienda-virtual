<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}


require_once '../db/db.php';

// Procesar formulario para crear o editar categoría
$errores = [];
$id = $_GET['id'] ?? null;
$nombre_categoria = '';

// Si es edición, cargar datos de la categoría
if ($id) {
    $sql = "SELECT * FROM categorias WHERE id = $id";
    $res = $conexion->query($sql);
    if ($res && $res->num_rows > 0) {
        $cat = $res->fetch_assoc();
        $nombre_categoria = $cat['nombre'];
      }
}

// Guardar categoría (crear o editar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_categoria = $_POST['nombre_categoria'] ?? '';
    if (empty($nombre_categoria)) {
        $errores[] = "El nombre de la categoría es obligatorio.";
      }

      if (empty($errores)) {
        if (isset($_POST['id']) && $_POST['id']) {
            // Editar
            $id_edit = intval($_POST['id']);
            $sql = "UPDATE categorias SET nombre='$nombre_categoria' WHERE id=$id_edit";
            $conexion->query($sql);
            } else {
              // Crear
              $sql = "INSERT INTO categorias (nombre) VALUES ('$nombre_categoria')";
              $conexion->query($sql);
            }
        // Redirigir para evitar reenvío de formulario
        header("Location: admin-gestionar-categoria.php");
        exit;
      }
    }

    // Eliminar categoría
if (isset($_GET['eliminar'])) {
    $id_eliminar = intval($_GET['eliminar']);
    $conexion->query("DELETE FROM categorias WHERE id=$id_eliminar");
    header("Location: admin-gestionar-categoria.php");
    exit;
  }

  // Obtener todas las categorías
  $categorias = [];
  $res = $conexion->query("SELECT * FROM categorias");
  if ($res) {
    $categorias = $res->fetch_all(MYSQLI_ASSOC);
  }
  ?>
  <?php include '../includes/header.php'; ?>

<main class="contenedor-tabla-gestion-categorias container mt-5">
  <h2 class="text-center mb-4 titulo-gestionar-categorias">GESTIÓN DE CATEGORÍAS</h2>
  
  <!-- Formulario para crear/editar categoría -->
  <div class="mb-4">
    <form class="row g-3" method="POST">
      <?php if ($id): ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>
      <div class="col-auto">
        <input type="text" class="form-control" name="nombre_categoria" placeholder="Nombre de la categoría" value="<?php echo htmlspecialchars($nombre_categoria); ?>">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success"><?php echo $id ? 'Actualizar' : 'Crear'; ?></button>
      </div>
      <?php if (!empty($errores)): ?>
        <div class="col-12">
          <div class="alert alert-danger">
            <?php foreach ($errores as $error) echo "<p>$error</p>"; ?>
          </div>
        </div>
      <?php endif; ?>
    </form>
  </div>

  <!-- Tabla de categorías -->
  <table class="table table-bordered text-center tabla-gestionar-categorias">
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>ACCIONES</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($categorias as $cat): ?>
      <tr>
        <td><?php echo $cat['id']; ?></td>
        <td><?php echo htmlspecialchars($cat['nombre']); ?></td>
        <td>
          <a href="admin-gestionar-categoria.php?id=<?php echo $cat['id']; ?>" class="btn btn-editar-gestionar-categorias me-2">Editar</a>
          <a href="admin-gestionar-categoria.php?eliminar=<?php echo $cat['id']; ?>" class="btn btn-eliminar-gestionar-categorias" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?');">Eliminar</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>

<?php include '../includes/footer.php'; ?>