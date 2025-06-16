<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row min-vh-100">
      
      <!--Panel de la izquierda (logo + nombre) -->
      <div class="col-md-6 d-flex flex-column justify-content-center align-items-center left-panel-register">
        <img src="../assets/icon-powerly.png" alt="Powerly" class="icon-powerly-register">
        <h1 class="title-powerly-register mt-3">POWERLY</h1>
      </div>

      <!-- Panel derecho (formulario de registro) -->
      <div class="col-md-6 d-flex justify-content-center align-items-center bg-white">
        <div class="register-form-right">
          <h2 class="form-title-register">Formulario de Registro</h2>

          <form action="" method="">
            <!-- Nombre y Apellido -->
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="nombre" class="form-label-register">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control input-register" required>
              </div>
              <div class="col-md-6">
                <label for="apellido" class="form-label-register">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control input-register" required>
              </div>
            </div>

            <!-- Correo -->
            <div class="mb-4">
              <label for="email" class="form-label-login">Correo Electrónico</label>
              <input type="email" id="email" name="email" class="form-control input-register-email" required>
            </div>

            <!-- Contraseña y Confirmación -->
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="password" class="form-label-register">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control input-register" required>
              </div>
              <div class="col-md-6">
                <label for="confirm-password" class="form-label-register">Confirmar Contraseña</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control input-register" required>
              </div>
            </div>

            <!-- Botón -->
            <button type="submit" class="btn btn-primary  btn-register">Registrar</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
