<?php include '../includes/header.php'; ?>

<main class="container mt-5 mb-5">
  <h2 class="text-center editar-producto-titulo">EDITAR PRODUCTO</h2>

  <form class="row editar-producto-formulario mt-4">
    
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
        <select class="form-select" id="editar-producto-categoria" name="categoria">
          <option value="">Seleccione</option>
        </select>
      </div>
    </div>

    <!-- Columna derecha -->
    <div class="col-md-6 d-flex flex-column align-items-center justify-content-start">
      <label for="editar-producto-imagen" class="form-label editar-producto-label">Imagen</label>
      <div id='preview-imagen' class="border mb-2" style="width: 200px; height: 200px; overflow: hidden;"></div>
      <input type="file" class="form-control editar-producto-file" id="editar-producto-imagen" name="imagen" style="width: 200px;">
    </div>

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
