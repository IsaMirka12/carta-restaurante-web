<?php


if (!isset($conexion) || !$conexion instanceof mysqli || !$conexion->ping()) {

    require_once __DIR__ . '/cargar_env.php';
    cargarEnv(__DIR__ . '/../.env');

    $host       = $_ENV['DB_HOST'] ?? 'localhost';
    $puerto     = $_ENV['DB_PORT'] ?? 3306;
    $usuario    = $_ENV['DB_USER'] ?? 'root';
    $contrasena = $_ENV['DB_PASS'] ?? '';
    $base_datos = $_ENV['DB_NAME'] ?? '';
    $ssl_ca_env = $_ENV['DB_SSL_CA'] ?? '';

     $clave = $_ENV['JWT_SECRET'];

    $ssl_ca = $ssl_ca_env ? realpath(__DIR__ . "/.." . $ssl_ca_env) : '';

    $conexion = mysqli_init();

    if ($ssl_ca && file_exists($ssl_ca)) {
        mysqli_ssl_set($conexion, NULL, NULL, $ssl_ca, NULL, NULL);
    }

    mysqli_real_connect(
        $conexion,
        $host,
        $usuario,
        $contrasena,
        $base_datos,
        (int)$puerto,
        NULL,
        MYSQLI_CLIENT_SSL
    );

    if (mysqli_connect_errno()) {
        error_log("Error de conexión: " . mysqli_connect_error());
        die("❌ Fallo al conectar a la base de datos: " . mysqli_connect_error());
    }

    $conexion->set_charset("utf8");
}
?>
