<?php

$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'tienda_sena');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

?>