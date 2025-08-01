<?php
session_start();
include('../conexion/conexion.php');

function buscarProductoId($idProducto, $conexion) {
    $stmt = $conexion->prepare("SELECT nombre, descripcion, precio, imagen, categoria_id FROM productos WHERE id = ?");
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->num_rows > 0 ? $resultado->fetch_assoc() : [];
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Datos inválidos']);
    exit;
}

$detalleProducto = buscarProductoId($id, $conexion);
if (empty($detalleProducto)) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Producto no encontrado']);
    exit;
}

$estaProductoEnMemoria = false;
$nombreProducto = $detalleProducto['nombre'];

foreach ($_SESSION['carrito'] as &$item) {
    if ($item['id'] === $id) {
        $item['precio'] = $detalleProducto['precio'];
        $item['nombre'] = $detalleProducto['nombre'];
        $item['imagen'] = $detalleProducto['imagen'];
        $item['cantidad']++;
        $estaProductoEnMemoria = true;
        break;
    }
}
unset($item);

if (!$estaProductoEnMemoria) {
    $_SESSION['carrito'][] = [
        'id'     => $id,
        'nombre' => $detalleProducto['nombre'],
        'precio' => $detalleProducto['precio'],
        'imagen' => $detalleProducto['imagen'],
        'cantidad' => 1,
    ];
}

echo json_encode([
    'status'  => 'ok',
    'mensaje' => "Producto $nombreProducto agregado correctamente!",
    'carrito_total' => count($_SESSION['carrito'])
]);
exit;

?>
