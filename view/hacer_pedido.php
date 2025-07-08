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

    $precios = [];
    while ($prod = $res->fetch_assoc()) {
        $id_producto = $prod['id'];
        $precios[$id_producto] = $prod['precio'];
        $total += $prod['precio'] * $carrito[$id_producto];
    }

    // Insertar pedido en la tabla pedidos
    $estado = 'pendiente';
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $stmt = $conexion->prepare("INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, total, estado, fecha, hora) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssdsss", $usuario_id, $provincia, $localidad, $direccion, $total, $estado, $fecha, $hora);

    if ($stmt->execute()) {
        $pedido_id = $stmt->insert_id;

        // Insertar cada producto en la tabla lineas_pedidos
        $stmt_linea = $conexion->prepare("INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) VALUES (?, ?, ?)");

        foreach ($carrito as $producto_id => $cantidad) {
            $stmt_linea->bind_param("iii", $pedido_id, $producto_id, $cantidad);
            $stmt_linea->execute();
        }

        // Limpiar carrito
        unset($_SESSION['carrito']);

        // Redirigir al detalle del pedido
        header("Location: detalle-pedido.php?id=" . $pedido_id);
        exit();
    } else {
        echo "Error al guardar el pedido: " . $stmt->error;
    }
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
