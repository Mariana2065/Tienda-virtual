<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

require_once '../db/db.php';
include '../includes/header.php';

// Cambiar estado del pedido si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pedido_id'], $_POST['nuevo_estado'])) {
    $pedido_id = intval($_POST['pedido_id']);
    $nuevo_estado = $_POST['nuevo_estado'];
    $stmt = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $nuevo_estado, $pedido_id);
    $stmt->execute();
}

// Filtrar por estado si se seleccionó
$estado_filtro = $_GET['estado'] ?? '';
$where = '';
$params = [];
$types = '';
if ($estado_filtro && in_array($estado_filtro, ['pendiente', 'en proceso', 'enviado', 'entregado'])) {
    $where = "WHERE estado = ?";
    $params[] = $estado_filtro;
    $types .= 's';
}

// Obtener todos los pedidos
$sql = "SELECT p.id, u.nombre AS usuario, p.provincia, p.localidad, p.direccion, p.total, p.estado, p.fecha 
        FROM pedidos p 
        JOIN usuarios u ON p.usuario_id = u.id 
        $where 
        ORDER BY p.fecha DESC, p.id DESC";
$stmt = $conexion->prepare($sql);
if ($where) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$pedidos = $result->fetch_all(MYSQLI_ASSOC);
?>

<main class="contenedor-tabla-pedidos-usuarios container mt-5">
  <h3 class="text-center mb-4">GESTIONAR PEDIDOS</h3>

  <form method="get" class="mb-3 d-flex align-items-center gap-2">
      <label for="estado" class="form-label mb-0">Filtrar por estado:</label>
      <select name="estado" id="estado" class="form-select w-auto" onchange="this.form.submit()">
          <option value="">Todos</option>
          <option value="pendiente" <?= $estado_filtro === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
          <option value="en proceso" <?= $estado_filtro === 'en proceso' ? 'selected' : '' ?>>En proceso</option>
          <option value="enviado" <?= $estado_filtro === 'enviado' ? 'selected' : '' ?>>Enviado</option>
          <option value="entregado" <?= $estado_filtro === 'entregado' ? 'selected' : '' ?>>Entregado</option>
      </select>
  </form>
  
  <table class="table tabla-pedidos text-center">
    <thead>
      <tr>
        <th>N° Pedido</th>
        <th>Usuario</th>
        <th>Provincia</th>
        <th>Localidad</th>
        <th>Dirección</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Cambiar estado</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($pedidos)): ?>
        <tr>
          <td colspan="9">No hay pedidos.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($pedidos as $pedido): ?>
          <tr>
            <td><?= htmlspecialchars($pedido['id']) ?></td>
            <td><?= htmlspecialchars($pedido['usuario']) ?></td>
            <td><?= htmlspecialchars($pedido['provincia']) ?></td>
            <td><?= htmlspecialchars($pedido['localidad']) ?></td>
            <td><?= htmlspecialchars($pedido['direccion']) ?></td>
            <td>$<?= number_format($pedido['total'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($pedido['fecha']) ?></td>
            <td><?= htmlspecialchars($pedido['estado']) ?></td>
            <td>
              <form method="post" class="d-flex align-items-center gap-2">
                <input type="hidden" name="pedido_id" value="<?= $pedido['id'] ?>">
                <select name="nuevo_estado" class="form-select form-select-sm w-auto">
                  <option value="pendiente" <?= $pedido['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                  <option value="en proceso" <?= $pedido['estado'] === 'en proceso' ? 'selected' : '' ?>>En proceso</option>
                  <option value="enviado" <?= $pedido['estado'] === 'enviado' ? 'selected' : '' ?>>Enviado</option>
                  <option value="entregado" <?= $pedido['estado'] === 'entregado' ? 'selected' : '' ?>>Entregado</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<?php include '../includes/footer.php'; ?>