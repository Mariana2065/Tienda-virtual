<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

  <title>Iniciar sesión</title>
</head>
<body>
  <div class="container-fluid">
    <div class="row min-vh-100">

      <!-- Panel izquierdo (formulario)-->
      <div class="col-md-6 d-flex align-items-center justify-content-center left-panel-login">
        <div class="login-form-container w-100" style="max-width: 400px;">
          <h2 class="form-title text-center mb-5">Iniciar sesión</h2>
          <form action="tu_url_de_procesamiento" method="POST">
            <div class="mb-3">
              <label class="form-label-login">Correo electrónico</label>
              <input type="email" name="email" class="form-control input-login" placeholder="Ingresa tu correo" required>
            </div>
            <div class="mb-4">
              <label class="form-label-login">Contraseña</label>
              <input type="password" name="password" class="form-control input-login" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
          </form>
        </div>
      </div>

      <!-- Panel derecho nombre + icono -->
      <div class="col-md-6 d-flex flex-column align-items-center justify-content-center right-panel-icon-login">
        <img src="../assets/icon-powerly.png" alt="Powerly" class="icon-powerly-login">
        <h1 class="title-powerly-login mt-3">POWERLY</h1>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
