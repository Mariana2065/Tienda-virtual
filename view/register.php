<?php

session_start();
require_once '../db/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellidos'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm-password'];

  $errores = [];

  if (empty($nombre)) {
    $errores[] = "El campo de nombre es obligatorio.";
  }

  if (empty($apellido)) {
    $errores[] = "El campo de apellido es obligatorio.";
  }

  if (empty($email)) {
    $errores[] = "El campo de correo electrónico es obligatorio.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El correo electrónico no es válido.";
  }

  if (empty($password)) {
    $errores[] = "El campo de contraseña es obligatorio.";
  } elseif (strlen($password) < 8) {
    $errores[] = "La contraseña debe tener al menos 8 caracteres.";
  }

  if ($password !== $confirm_password) {
    $errores[] = "Las contraseñas no coinciden.";
  }
  $check = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    $errores[] = "Ya existe una cuenta con este correo electrónico.";
  }
$check->close();

  if(empty($errores)){
    // Preparar la consulta para insertar el usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, email, password) VALUES (?, ?, ?, ?)");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    if ($stmt) {
      $stmt->bind_param("ssss", $nombre, $apellido, $email, $hashed_password);
      if ($stmt->execute()) {
        $_SESSION['success'] = "Registro exitoso. Puedes iniciar sesión ahora.";
        header("Location: login.php");
        exit();
      } else {
        $errores[] = "Error al registrar el usuario: " . $stmt->error;
      }
      $stmt->close();
    } else {
      $errores[] = "Error al preparar la consulta: " . $conexion->error;
    }
  }
}

?>
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
          <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
          <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']); // Limpiar el mensaje después de mostrarlo
          ?>
            </div>
          <?php endif; ?>
          <form action="" method="POST">
            <!-- Nombre y Apellido -->
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="nombre" class="form-label-register">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control input-register" required>
              </div>
              <div class="col-md-6">
                <label for="apellido" class="form-label-register">Apellido</label>
                <input type="text" id="apellido" name="apellidos" class="form-control input-register" required>
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
              <?php
                if (isset($error) && !empty($error)) {
                echo '<div class="alert alert-danger mt-3">' . htmlspecialchars($error) . '</div>';
            }
?>
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
