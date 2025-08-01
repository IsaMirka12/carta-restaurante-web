<?php
include '../conexion/conexion.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "UPDATE productos SET estado = 0 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>

