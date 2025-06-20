<?php
//includes de la barra de los filtros
?>
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
      