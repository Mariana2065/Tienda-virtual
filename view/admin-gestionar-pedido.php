<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}


include '../includes/header.php'; ?>

<main class="contenedor-tabla-pedidos-usuarios container mt-5">
  <h3 class="text-center mb-4">GESTIONAR PEDIDOS</h3>
  
  <table class="table tabla-pedidos text-center">
    <thead>
      <tr>
        <th>N° Referencia</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>0001</td>
        <td>$00000</td>
        <td>1243-56-09</td>
        <td>Enviado</td>
      </tr>
      <tr>
        <td>0001</td>
        <td>$00000</td>
        <td>1243-56-09</td>
        <td>Pendiente</td>
      </tr>
    </tbody>
  </table>
</main>

    <?php include '../includes/footer.php'; ?>