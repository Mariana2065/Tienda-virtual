<?php 
//include del header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Powerly Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    
    <header class="header">
        <!-- Menú hamburguesa -->
        <button class="icon-menu-btn me-3" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
            <img src="../assets/icon-menú.png" class="lista-desplegable"></img>
        </button>

        <!-- Logo -->
        <a class="logo-header d-flex align-items-center mx-auto" href="#">
            <img src="../assets/icon-powerly.png" alt="Logo powerly" class="logo-powerly-header">
            <strong>POWERLY</strong>
        </a>

        <!-- Íconos de carrito y perfil -->
        <div class="d-flex gap-4">
            <a href="#" class="icon-btn"><img src="../assets/icon-carrito-compras.png" class="icon-perfil"></img></a>
            <a href="#" class="icon-btn"><img src="../assets/icon-perfil.png" class="icon-carrito-compras"></img></a>
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
                <li class="nav-item"><a href="#" class="nav-link text-white"><button class="btn-cerrar-sesion">Cerrar sesión</button></a></li>
            </ul>
        </div>
    </div>

    <!-- Nav categorias-->
    <nav class="nav-categorias">
        <ul>
            <li>Inicio</li>
            <li>Categoria</li>
            <li>Categoria</li>
            <li>Categoria</li>
            <li>Categoria</li>
        </ul>
    </nav>