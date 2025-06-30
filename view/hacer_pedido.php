<?php
session_start();
require_once '../db/db.php';

// Solo usuarios logueados pueden hacer pedidos
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Verifica que el carrito no esté vacío
if (empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

$usuario_id = $_SESSION['usuario']['id'];
$carrito = $_SESSION['carrito'];

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $provincia = $_POST['provincia'] ?? '';
    $localidad = $_POST['localidad'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $metodo_pago = $_POST['metodo_pago'] ?? 'Pago en entrega';

    // Calcular total
    $total = 0;
    $ids = implode(',', array_keys($carrito));
    $res = $conexion->query("SELECT id, precio FROM productos WHERE id IN ($ids)");
    while ($prod = $res->fetch_assoc()) {
        $prod_id = $prod['id'];
        $cantidad = $carrito[$prod_id];
        $total += $prod['precio'] * $cantidad;
    }

    // Insertar pedido con datos de envío
    $estado = 'pendiente';
    $fecha = date('Y-m-d');
    $stmt = $conexion->prepare("INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, total, estado, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssdss", $usuario_id, $provincia, $localidad, $direccion, $total, $estado, $fecha);
    $stmt->execute();
    $pedido_id = $stmt->insert_id;

    // (Opcional) Aquí puedes guardar los productos del pedido en otra tabla, si tienes una tabla detalle_pedidos

    // Limpiar carrito
    unset($_SESSION['carrito']);

    // Redirigir al historial de pedidos
    header("Location: pedidos-usuarios.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2>Finalizar pedido</h2>
    <form method="post" class="mt-4">
        <div class="mb-3">
            <label for="provincia" class="form-label">Provincia</label>
            <input type="text" class="form-control" id="provincia" name="provincia" required>
        </div>
        <div class="mb-3">
            <label for="localidad" class="form-label">Localidad</label>
            <input type="text" class="form-control" id="localidad" name="localidad" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <div class="mb-3">
            <label for="metodo_pago" class="form-label">Método de pago</label>
            <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                <option value="Pago en entrega">Pago en entrega</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Confirmar pedido</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>