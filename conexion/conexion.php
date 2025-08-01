<?php

require_once __DIR__ . '/cargar_env.php';
cargarEnv(__DIR__ . '/../.env');

$host = $_ENV['DB_HOST'];
$usuario = $_ENV['DB_USER'];
$contrasena = $_ENV['DB_PASS'];
$base_datos = $_ENV['DB_NAME'];

$jwts = $_ENV['JWT_SECRET'];

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);
// if ($conexion->connect_error) {
//     die("Conexión fallida: " . $conexion->connect_error);
// } else {
//     echo "Conexión exitosa<br>";
// }
$conexion->set_charset("utf8");

?>
