<?php
include '../conexion/conexion.php'; 

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data["idProducto"])) {
    echo json_encode(["success" => false, "msg" => "Datos incompletos"]);
    exit;
}

$id = intval($data["idProducto"]);
$nombre = trim($data['nombre']);
$descripcion = trim($data['descripcion']);
$precio = floatval($data['precio']);
$imagen = trim($data['imagen']);
$categoria = intval($data['categoria']);

$sql = "UPDATE productos SET 
            nombre = ?, 
            descripcion = ?, 
            precio = ?, 
            imagen = ?, 
            categoria_id = ?
        WHERE id = ?";

$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    echo json_encode(["success" => false, "msg" => "Error en prepare: " . $conexion->error]);
    exit;
}

$stmt->bind_param("ssdsii", $nombre, $descripcion, $precio, $imagen, $categoria, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "msg" => "Producto actualizado correctamente"]);
} else {
    echo json_encode(["success" => false, "msg" => "Error al actualizar: " . $stmt->error]);
}

$stmt->close();
$conexion->close();
