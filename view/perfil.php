<?php
session_start();
require_once '../db/db.php';

// Solo usuarios logueados pueden ver su perfil
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];
$mensaje = '';
$error = '';

// Obtener datos del usuario
$stmt = $conexion->prepare("SELECT nombre, apellidos, email FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($nombre, $apellido, $email);
$stmt->fetch();
$stmt->close();

// Actualizar datos personales
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_datos'])) {
    $nuevo_nombre = trim($_POST['nombre'] ?? '');
    $nuevo_apellido = trim($_POST['apellido'] ?? '');
    $nuevo_email = trim($_POST['email'] ?? '');

    if (empty($nuevo_nombre) || empty($nuevo_apellido) || empty($nuevo_email)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($nuevo_email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    } else {
        // Verificar si el correo ya existe para otro usuario
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
        $stmt->bind_param("si", $nuevo_email, $usuario_id);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error = "El correo electrónico ya está en uso por otro usuario.";
        } else {
            $stmt->close();
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nuevo_nombre, $nuevo_apellido, $nuevo_email, $usuario_id);
            if ($stmt->execute()) {
                $mensaje = "Datos personales actualizados correctamente.";
                $nombre = $nuevo_nombre;
                $apellido = $nuevo_apellido;
                $email = $nuevo_email;
                // Actualizar sesión
                $_SESSION['usuario']['nombre'] = $nuevo_nombre;
                $_SESSION['usuario']['apellido'] = $nuevo_apellido;
                $_SESSION['usuario']['email'] = $nuevo_email;
            } else {
                $error = "Error al actualizar los datos personales.";
            }
        }
        $stmt->close();
    }
}

// Cambiar contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_password'])) {
    $password_actual = $_POST['password_actual'] ?? '';
    $password_nueva = $_POST['password_nueva'] ?? '';
    $password_confirmar = $_POST['password_confirmar'] ?? '';

    if (empty($password_actual) || empty($password_nueva) || empty($password_confirmar)) {
        $error = "Todos los campos son obligatorios para cambiar la contraseña.";
    } elseif ($password_nueva !== $password_confirmar) {
        $error = "La nueva contraseña y la confirmación no coinciden.";
    } elseif (strlen($password_nueva) < 6) {
        $error = "La nueva contraseña debe tener al menos 6 caracteres.";
    } else {
        $stmt = $conexion->prepare("SELECT password FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $stmt->bind_result($password_hash);
        $stmt->fetch();
        $stmt->close();

        if (!password_verify($password_actual, $password_hash)) {
            $error = "La contraseña actual es incorrecta.";
        } else {
            $nueva_hash = password_hash($password_nueva, PASSWORD_DEFAULT);
            $stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $nueva_hash, $usuario_id);
            if ($stmt->execute()) {
                $mensaje = "Contraseña actualizada correctamente.";
            } else {
                $error = "Error al actualizar la contraseña.";
            }
            $stmt->close();
        }
    }
}

include '../includes/header.php';
?>

<div class="container">
    <h2>Mi perfil</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Datos personales</h5>
                    <?php if ($mensaje && !isset($_POST['actualizar_password'])): ?>
                        <div class="alert alert-success"><?= $mensaje ?></div>
                    <?php elseif ($error && !isset($_POST['actualizar_password'])): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control input-perfil" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control input-perfil" id="apellido" name="apellido" value="<?= htmlspecialchars($apellido) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control input-perfil" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                        </div>
                        <button type="submit" name="actualizar_datos" class="btn btn-primary btn-perfil">Actualizar datos</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Cambiar contraseña</h5>
                    <?php if ($mensaje && isset($_POST['actualizar_password'])): ?>
                        <div class="alert alert-success"><?= $mensaje ?></div>
                    <?php elseif ($error && isset($_POST['actualizar_password'])): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="post" autocomplete="off">
                        <div class="mb-3">
                            <label for="password_actual" class="form-label">Contraseña actual</label>
                            <input type="password" class="form-control input-perfil" id="password_actual" name="password_actual" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_nueva" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control input-perfil" id="password_nueva" name="password_nueva" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmar" class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" class="form-control input-perfil" id="password_confirmar" name="password_confirmar" required minlength="6">
                        </div>
                        <button type="submit" name="actualizar_password" class="btn btn-primary btn-perfil">Actualizar contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>