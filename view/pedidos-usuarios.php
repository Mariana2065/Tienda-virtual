<?php
session_start();
require_once '../db/db.php';
include '../includes/header.php';

// Solo usuarios logueados pueden ver sus pedidos
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];

// Obtener los pedidos del usuario actual
$pedidos = [];
$sql = "SELECT id, total, fecha, estado FROM pedidos WHERE usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    $pedidos = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<main class="contenedor-tabla-pedidos-usuarios container mt-5">
  <h3 class="text-center mb-4">MIS PEDIDOS</h3>
  
  <table class="table tabla-pedidos text-center">
    <thead>
      <tr>
        <th>N° Pedido</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Detalle</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($pedidos)): ?>
        <tr>
          <td colspan="5">No tienes pedidos aún.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($pedidos as $pedido): ?>
          <tr>
            <td><?= htmlspecialchars($pedido['id']) ?></td>
            <td>$<?= number_format($pedido['total'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($pedido['fecha']) ?></td>
            <td><?= htmlspecialchars($pedido['estado']) ?></td>
            <td>
              <a href="detalle-pedido.php?id=<?= $pedido['id'] ?>" class="btn btn-primary btn-sm">Ver detalle</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<?php include '../includes/footer.php'; ?>
