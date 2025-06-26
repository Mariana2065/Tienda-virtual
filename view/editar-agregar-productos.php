<?php include '../includes/header.php'; ?>
<?php
require_once '../db/db.php';

// Obtener categorías
$categorias = [];
$resultado = $conexion->query("SELECT id, nombre FROM categorias");
if ($resultado) {
    $categorias = $resultado->fetch_all(MYSQLI_ASSOC);
}

$errores = [];

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validaciones básicas
    if (empty($_POST['nombre'])) $errores[] = "El nombre es obligatorio.";
    if (empty($_POST['precio'])) $errores[] = "El precio es obligatorio.";
    if (empty($_POST['categoria'])) $errores[] = "La categoría es obligatoria.";

    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = floatval($_POST['precio'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);
    $categoria = intval($_POST['categoria'] ?? 0);

    // Manejo de imagen
    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $rutaDestino = '../assets/' . $nombreImagen;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $imagen = $nombreImagen;
        } else {
            $errores[] = "Error al subir la imagen.";
        }
    }

    // Guardar en la base de datos si no hay errores
    if (empty($errores)) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, imagen)
                VALUES ('$nombre', '$descripcion', $precio, $stock, $categoria, " . ($imagen ? "'$imagen'" : "NULL") . ")";
        if ($conexion->query($sql)) {
            echo '<div class="alert alert-success">Producto guardado correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger">Error al guardar el producto: ' . $conexion->error . '</div>';
        }
    }
}
?>
<main class="container mt-5 mb-5">
  <h2 class="text-center editar-producto-titulo">EDITAR PRODUCTO</h2>

  <form class="row editar-producto-formulario mt-4" method='POST' enctype='multipart/form-data'>
    
    <!-- Columna izquierda -->
    <div class="col-md-6">
      <div class="mb-3">
        <label for="editar-producto-nombre" class=" editar-producto-label">Nombre</label>
        <input type="text" class="form-control" id="editar-producto-nombre" name="nombre">
      </div>

      <div class="mb-3">
        <label for="editar-producto-descripcion" class=" editar-producto-label">Descripción</label>
        <textarea class="form-control" id="editar-producto-descripcion" name="descripcion" rows="3"></textarea>
      </div>

      <div class="mb-3">
        <label for="editar-producto-precio" class=" editar-producto-label">Precio</label>
        <input type="text" class="form-control" id="editar-producto-precio" name="precio">
      </div>

      <div class="mb-3">
        <label for="editar-producto-stock" class="editar-producto-label">Stock</label>
        <input type="number" class="form-control" id="editar-producto-stock" name="stock">
      </div>

      <div class="mb-3">
        <label for="editar-producto-categoria" class="editar-producto-label">Categoría</label>
        <select class="form-select" id="editar-producto-categoria" name="categoria" required>
          <option value="">Seleccione</option>
          <?php foreach ($categorias as $cat): ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>

    <!-- Columna derecha -->
    <div class="col-md-6 d-flex flex-column align-items-center justify-content-start">
      <label for="editar-producto-imagen" class="form-label editar-producto-label">Imagen</label>
      <div id='preview-imagen' class="border mb-2" style="width: 200px; height: 200px; overflow: hidden;"></div>
      <input type="file" class="form-control editar-producto-file" id="editar-producto-imagen" name="imagen" style="width: 200px;">
    </div>
    <?php if (!empty($errores)): ?>
  <div class="alert alert-danger">
    <?php foreach ($errores as $error) echo "<p>$error</p>"; ?>
  </div>
<?php endif; ?>
    <!-- Botón -->
    <div class="col-12 text-center mt-4">
      <button type="submit" class="editar-producto-btn btn btn-success px-4 py-2 fw-bold">Guardar</button>
    </div>
  </form>
</main>
<script>
document.getElementById('editar-producto-imagen').addEventListener('change', function(event) {
  const file = event.target.files[0];
  const preview = document.getElementById('preview-imagen');
  preview.innerHTML = ""; // Limpiar preview anterior
  if (file && file.type.startsWith('image/')) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const img = document.createElement('img');
      img.src = e.target.result;
      img.style.width = "100%";
      img.style.height = "100%";
      img.style.objectFit = "cover"; // Cambia 'contain' por 'cover'
      img.style.display = "block";
      preview.appendChild(img);
    };
    reader.readAsDataURL(file);
  }
});
</script>
<?php include '../includes/footer.php'; ?>
