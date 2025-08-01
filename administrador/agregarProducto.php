<?php
include '../conexion/conexion.php';

$data = json_decode(file_get_contents('php://input'), true);

$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$precio = $data['precio'];
$imagen = $data['imagen'];
$categoria = $data['categoria'];

$sqlCategoria = "SELECT id FROM categorias WHERE nombre = ?";
$stmt = $conexion->prepare($sqlCategoria);
$stmt->bind_param("s", $categoria);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $categoria_id = $row['id'];

    $sqlInsert = "INSERT INTO productos (nombre, descripcion, precio, imagen, categoria_id, estado) VALUES (?, ?, ?, ?, ?, 1)";
    $stmtInsert = $conexion->prepare($sqlInsert);
    $stmtInsert->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $categoria_id);

    if ($stmtInsert->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al guardar']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Categoría no válida']);
}

$conexion->close();
?>
