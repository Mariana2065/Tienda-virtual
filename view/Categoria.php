<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Powerly Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <!-- Menú hamburguesa -->
        <button class="icon-menu-btn me-3" data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
            <img src="./issets/icon-menú.png" class="lista-desplegable"></img>
        </button>

        <!-- Logo -->
        <a class="logo-header d-flex align-items-center mx-auto" href="#">
            <img src="./issets/icon-powerly.png" alt="Logo powerly" class="logo-powerly-header">
            <strong>POWERLY</strong>
        </a>

        <!-- Íconos de carrito y perfil -->
        <div class="d-flex gap-4">
            <a href="#" class="icon-btn"><img src="./issets/icon-carrito-compras.png" class="icon-perfil"></img></a>
            <a href="#" class="icon-btn"><img src="./issets/icon-perfil.png" class="icon-carrito-compras"></img></a>
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

    <!-- FILTROS Y PRODUCTOS -->
<div class="container-fluid mt-4">
  <div class="row">
    <!-- PANEL DE FILTROS -->
    <aside class="col-12 col-md-4 col-lg-2 mb-3">
      <div class="contenedor-filtros">
        <div class="contenedor-btn-filtros">
          <!--Filtro de ordenar-->
                        <div class="dropdown">
                            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                               Ordenar
                            <ul class="dropdown-menu p-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="orden" id="mayor" value="mayor">
                                    <label class="form-check-label" for="mayor">De mayor a menor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="orden" id="menor" value="menor">
                                    <label class="form-check-label" for="menor">De menor a mayor</label>
                                </div>
                            </ul>
                        </div>
                        <!--Género-->
                        <div class="dropdown">
                            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Género
                            </button>
                            <ul class="dropdown-menu p-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" id="mujer" value="mujer">
                                    <label class="form-check-label" for="mayor">mujer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" id="hombre" value="hombre">
                                    <label class="form-check-label" for="menor">Hombre</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="genero" id="Unisex" value="Unisex">
                                    <label class="form-check-label" for="menor">Unisex</label>
                                </div>
                            </ul>
                        </div>
                        <!--Deporte-->
                        <div class="dropdown">
                            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Deporte
                            </button>
                            <ul class="dropdown-menu p-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="deporte" id="golf" value="golf">
                                    <label class="form-check-label" for="mayor">golf</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="deporte" id="box" value="box">
                                    <label class="form-check-label" for="menor">Box</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="deporte" id="tenis" value="tenis">
                                    <label class="form-check-label" for="menor">Tenis</label>
                                </div>
                            </ul>
                        </div>
                        <!--Marca-->
                        <div class="dropdown">
                            <button class="btn dropdown-toggle btn-desplegable" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Marca
                            </button>
                            <ul class="dropdown-menu p-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marca" id="x" value="x">
                                    <label class="form-check-label" for="mayor">Marca</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marca" id="x" value="x">
                                    <label class="form-check-label" for="menor">marca</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marca" id="x" value="x">
                                    <label class="form-check-label" for="menor">Marca</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
    </aside>
      

    <!-- PANEL DE PRODUCTOS -->
    <main class="col-12 col-md-9 col-lg-10">
      <div class="contenedor-productos d-flex flex-wrap gap-3">
        <!--Tarjetas-->
       <div class="card" style="width: 18rem;">
          <img src="./issets/icon-powerly.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">$0000</p>
            <p class="card-text">Nombre</p>
            <p class="card-text">Descripción</p>
          </div>
        </div>
         <div class="card" style="width: 18rem;">
          <img src="./issets/icon-powerly.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">$0000</p>
            <p class="card-text">Nombre</p>
            <p class="card-text">Descripción</p>
          </div>
        </div>
         <div class="card" style="width: 18rem;">
          <img src="./issets/icon-powerly.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">$0000</p>
            <p class="card-text">Nombre</p>
            <p class="card-text">Descripción</p>
          </div>
        </div>
          <!--Tarjetas 2-->
       <div class="card" style="width: 18rem;">
          <img src="./issets/icon-powerly.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">$0000</p>
            <p class="card-text">Nombre</p>
            <p class="card-text">Descripción</p>
          </div>
        </div>
         <div class="card" style="width: 18rem;">
          <img src="./issets/icon-powerly.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">$0000</p>
            <p class="card-text">Nombre</p>
            <p class="card-text">Descripción</p>
          </div>
        </div>
         <div class="card" style="width: 18rem;">
          <img src="./issets/icon-powerly.png" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">$0000</p>
            <p class="card-text">Nombre</p>
            <p class="card-text">Descripción</p>
          </div>
        </div>
       
      </div>
    </main>
  </div>
</div>
<footer class="footer-powely">
  <div class="logo-footer d-flex align-items-center">
    <img src="./issets/icon-powerly.png" alt="Logo Powerly" class="logo-powerly-footer">
    <strong>POWERLY</strong>
  </div>
  <p>&copy; 2025 Powerly | Todos los derechos reservados.</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
