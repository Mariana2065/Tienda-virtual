<?php
require_once '../db/db.php';

// Obtener categorías para el menú
$categorias_menu = [];
$res = $conexion->query("SELECT id, nombre FROM categorias");
if ($res) {
    $categorias_menu = $res->fetch_all(MYSQLI_ASSOC);
}

// Define la ruta base de tu proyecto
$base = '/Virtual_Store/Tienda-virtual';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Powerly Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo $base; ?>../view/css/style.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <!-- Menú hamburguesa -->
        <button class="icon-menu-btn me-3" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
            <img src="<?php echo $base; ?>/assets/icon-menú.png" class="lista-desplegable" alt="Menú">
        </button>

        <!-- Logo -->
        <a class="logo-header d-flex align-items-center mx-auto" href="<?php echo $base; ?>/index.php">
            <img src="<?php echo $base; ?>/assets/icon-powerly.png" alt="Logo powerly" class="logo-powerly-header">
            <strong>POWERLY</strong>
        </a>

        <!-- Íconos de carrito y perfil -->
        <div class="d-flex gap-4">
            <a href="#" class="icon-btn"><img src="<?php echo $base; ?>/assets/icon-carrito-compras.png" class="icon-perfil" alt="Carrito"></a>
            <a href="#" class="icon-btn"><img src="<?php echo $base; ?>/assets/icon-perfil.png" class="icon-carrito-compras" alt="Perfil"></a>
        </div>
    </header>

    <!-- Offcanvas lateral-->
    <div class="offcanvas offcanvas-start menu-burguer" tabindex="-1" id="menuLateral">
        <div class="offcanvas-header ">
            <h5 class="offcanvas-title">Menú</h5>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link text-black">Mis pedidos</a></li>
                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'admin'): ?>
                <li class="nav-item">
                <a class="nav-link" href="admin-gestionar-pedido.php">Gestionar pedidos</a>
                </li>
                <?php endif; ?>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white"><button class="btn-cerrar-sesion">Cerrar sesión</button></a></li>
            </ul>
        </div>
    </div>

    <!-- Nav categorias dinámico -->
    <nav class="nav-categorias">
        <ul>
            <li><a href="<?php echo $base; ?>/index.php">Inicio</a></li>
            <?php foreach ($categorias_menu as $cat): ?>
                <li>
                    <a href="<?php echo $base; ?>/view/Categoria.php?id=<?php echo $cat['id']; ?>">
                        <?php echo htmlspecialchars($cat['nombre']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>