<?php
include '../conexion/conexion.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "SELECT p.nombre, p.descripcion, p.precio, p.imagen, c.nombre AS categoria
            FROM productos p
            INNER JOIN categorias c ON p.categoria_id = c.id
            WHERE p.id = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $resultado = $stmt->get_result();
        $producto = $resultado->fetch_assoc();

        if ($producto) {
            echo json_encode([
                'success' => true,
                'producto' => $producto
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Producto no encontrado'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al ejecutar la consulta'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'ID no proporcionado'
    ]);
}
?>
