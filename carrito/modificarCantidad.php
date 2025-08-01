<?php
session_start();

$id = (int)($_POST['id'] ?? 0);
$cantidad = (int)($_POST['cantidad'] ?? 0);

if(!$cantidad) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Datos inválidos']);
    exit;
}


if($cantidad < 0) {
    $cantidad = 0;
}

if ($id <= 0) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Datos inválidos']);
    exit;
}

if (!isset($_SESSION['carrito'])) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Carrito vacío']);
    exit;
}

$productoEncontrado = false;
$producto = null;
$total = 0;

for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
     $item = $_SESSION['carrito'][$i];
    if ($item['id'] === $id) {
           $total = $total + ($cantidad*$item['precio']);
    } else {
         $total = $total + ($item['cantidad']*$item['precio']);
    }
}

for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
    $item = $_SESSION['carrito'][$i];
    if ($item['id'] === $id) {
        if ($cantidad <= 0) {
            unset($_SESSION['carrito'][$i]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            $nombre = $item['nombre'];
            echo json_encode([
            'status' => 'ok',
            'mensaje' => "Producto eliminado $nombre !",
            'productos' => $_SESSION['carrito'],
            'total' => $total,
        ]);
            exit;
        }

        $_SESSION['carrito'][$i]['cantidad'] = $cantidad;
        $producto = $_SESSION['carrito'][$i];
        $productoEncontrado = true;
        break;
    }
}

if (!$productoEncontrado) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Producto no encontrado en el carrito']);
    exit;
}


echo json_encode([
    'status' => 'ok',
    'mensaje' => " $cantidad Cantidad actualizada al producto!",
    'subtotal' => $producto['cantidad'] * $producto['precio'],
    'productos' => $_SESSION['carrito'],
    'total' => $total
]);
exit;
?>
