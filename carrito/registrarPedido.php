<?php
session_start();
include('../conexion/conexion.php');

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo json_encode(['status' => 'error', 'mensaje' => 'El carrito está vacío']);
    exit;
}

$cliente_id = 1; 
$metodo_pago = 'Efectivo'; 
$estado = 'pendiente';
$fecha = date('Y-m-d H:i:s');
$total = 0;

foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

$conexion->begin_transaction();

try {

    $stmtPedido = $conexion->prepare(
        "INSERT INTO pedido (cliente_id, fecha, total, metodo_pago, estado)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmtPedido->bind_param("isdss", $cliente_id, $fecha, $total, $metodo_pago, $estado);
    $stmtPedido->execute();

    $pedidoId = $stmtPedido->insert_id;
    $numeroPedido = str_pad($pedidoId, 6, '0', STR_PAD_LEFT);
    $numeroPedido = 'N°'.$numeroPedido;
    $stmtUpdate = $conexion->prepare("UPDATE pedido SET numeroPedido = ? WHERE id = ?");
    $stmtUpdate->bind_param("si", $numeroPedido, $pedidoId);
    $stmtUpdate->execute();

    $stmtDetalle = $conexion->prepare(
        "INSERT INTO pedido_detalle (pedido_id, producto_id, cantidad, precio_unitario)
         VALUES (?, ?, ?, ?)"
    );

    foreach ($_SESSION['carrito'] as $item) {
        $stmtDetalle->bind_param("iiid", $pedidoId, $item['id'], $item['cantidad'], $item['precio']);
        $stmtDetalle->execute();
    }
    $detallePedidoId = $stmtDetalle->insert_id;

    $sql = "
    SELECT pe.id AS pedido_id, pe.metodo_pago, pe.estado, pe.numeroPedido,
    pd.producto_id, p.nombre, pd.cantidad, pd.precio_unitario
    FROM pedido pe
    JOIN pedido_detalle pd ON pe.id = pd.pedido_id
    JOIN productos p ON pd.producto_id = p.id
    WHERE pe.id = ?
    ";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $pedidoId);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $productosObtenidosBd = [];

    while ($fila = $resultado->fetch_assoc()) {
        $productosObtenidosBd[] = $fila;
    }


    $conexion->commit();

    unset($_SESSION['carrito']); 
    $_SESSION['carrito'] = [];

    $pedidoWhatsap = array(
        'idPedido'    => $pedidoId,
        'numPedido'   => $numeroPedido,
        'total'       => $total,
        'clienteId'   => $cliente_id,
        'metodoPago'  => $metodo_pago,
        'estado'      => $estado
    );

    echo json_encode([
        'status' => 'ok', 
        'mensaje' => 'Pedido registrado correctamente',
        'dataWts' => $pedidoWhatsap,
        'productBd' => $productosObtenidosBd,
        'detallePedidoId' => $detallePedidoId
        ]);
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode(['status' => 'error', 'mensaje' => 'Error al registrar el pedido: ' . $e->getMessage()]);
}
?>
