<?php

include 'conexion.php';

// Obtener término de búsqueda (desde GET o POST)
$busqueda = isset($_GET['nombre']) ? $_GET['nombre'] : '';

$sql = "SELECT p.nombre, p.descripcion, p.precio, p.imagen, c.nombre AS categoria
        FROM productos p
        INNER JOIN categorias c ON p.categoria_id = c.id
        WHERE p.nombre LIKE ?";

$stmt = $conn->prepare($sql);
$param = "%" . $busqueda . "%";
$stmt->bind_param("s", $param);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "<h3>" . $fila["nombre"] . "</h3>";
        echo "<p><strong>Categoría:</strong> " . $fila["categoria"] . "</p>";
        echo "<p>" . $fila["descripcion"] . "</p>";
        echo "<p>Precio: S/. " . $fila["precio"] . "</p>";
        echo "<img src='" . $fila["imagen"] . "' width='150'><hr>";
    }
} else {
    echo "No se encontraron productos con ese nombre.";
}

$conn->close();
?>
