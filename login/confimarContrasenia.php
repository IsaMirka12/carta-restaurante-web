<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../estilos/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" href="https://i.postimg.cc/Bv4bSbnx/logo.webp" type="image/x-icon">
    <title>Confirmar Registro</title>
</head>
<body>

<div class="top-banner d-none d-md-block">
    <div class="marquee">
        <span><b>Bienvenido a Korean-Food la mejor experiencia de comida coreana en Perú 🇰🇷✨</span>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container-fluid px-4">
      <a class="navbar-brand" href="/miProyecto/index.php">
      <img src="https://i.postimg.cc/Ph866nvv/7734086.jpg" alt="Logo" class="logo-header">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="menu">
      <ul class="navbar-nav ms-auto me-4 text-uppercase">
          <li class="nav-item"><a class="nav-link" href="../index.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="../nosotros.php">Nosotros</a></li>
          <li class="nav-item"><a class="nav-link" href="../carrito.php"><i class="bi bi-cart-plus"></i> mi pedido</a></li>
          <li class="nav-item"><a class="nav-link" href="/login/login.php"><i class="bi bi-person-add"></i></a></li>
      </ul>
      </div>
    </div>
</nav>


  <section class="hero-section">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8">
      <div class="bg-white p-5 shadow-lg rounded-4 border border-2" style="border-color: #9e1b1b;">
        <div class="text-center mb-4">
          <h1 class="display-5 fw-bold" style="color: #9e1b1b;">Registro de clave</h1>
          <p class="lead text-muted">Ingresa tu nueva contraseña para completar el proceso</p>
        </div>

        <form class="needs-validation d-flex flex-column align-items-center gap-3" method="POST" action="" novalidate>
          <div class="col-md-8">
            <label for="validationCustom01" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="validationCustom01" name="password" required>
            <div class="valid-feedback">Perfecto</div>
          </div>

          <div class="col-md-8">
            <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            <div class="valid-feedback">Perfecto</div>
          </div>

          <button type="submit" class="btn rounded-pill px-4 py-2 mt-3" style="background-color: #9e1b1b; color: #fff;">
            Guardar contraseña
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<footer class="footer-custom">
  <div class="container px-4">
    <div class="row">
      <div class="col-md-4 mb-4">
        <img src="https://i.postimg.cc/Ph866nvv/7734086.jpg" alt="Logo Footer" class="logo-footer mb-3">
        <p>Auténtica cocina coreana. Calidad, sabor y tradición en cada plato.</p>
      </div>
      <div class="col-md-4 mb-4">
        <h5 class="footer-title">Enlaces rápidos</h5>
        <ul class="list-unstyled">
          <li><a href="../index.php">Inicio</a></li>
          <li><a href="../carrito.php">Mi Pedido</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-4">
        <h5 class="footer-title">Contáctanos</h5>
        <p><i class="bi bi-geo-alt-fill me-2"></i> Av. Benavides 1234, Lima, Perú</p>
        <p><i class="bi bi-envelope-fill me-2"></i> contacto@kfood.pe</p>
        <p><i class="bi bi-phone-fill me-2"></i> +51 999 888 777</p>
      </div>
    </div>
    <hr class="border-light">
    <div class="text-center">
      © 2025 Korean_food - Todos los derechos (MIQS).
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
</body>
</html>

<script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?php

require_once '../libs/JWT/JWTExceptionWithPayloadInterface.php';
require_once '../libs/JWT/BeforeValidException.php';
require_once '../libs/JWT/ExpiredException.php';
require_once '../libs/JWT/SignatureInvalidException.php';
require_once '../libs/JWT/Key.php';
require_once '../libs/JWT/JWT.php';
include '../conexion/conexion.php';


$token = $_GET['token'] ?? null;

if (!$token || $token === 'null' || substr_count($token, '.') !== 2) {
    echo "<script>alertify.error('El Token no es válido o no existe');</script>";
    exit;
}

try {

    $decoded = JWT::decode($token, new Key($jwts, 'HS256'));
    $sql = "SELECT estado FROM tokens WHERE token= ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) throw new Exception("Error al preparar la consulta: " . $conexion->error);

    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->bind_result($estado);

    if ($stmt->fetch()) {
        if ($estado === 0) {
            echo "<script>alertify.error('El token ya fue usado');</script>";
            exit;
        }
    } else {
        echo "<script>alertify.error('Token no encontrado');</script>";
        exit;
    }
    $stmt->close();

} catch (ExpiredException $e) {
    echo "<script>alertify.error('El token ha expirado. Solicita uno nuevo.');</script>";
    exit;
} catch (Exception $e) {
    echo "<script>alertify.error('Token inválido: " . htmlspecialchars($e->getMessage()) . "');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<script>alertify.success('Bienvenido. Puedes crear tu nueva contraseña.');</script>";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');

    if (!$password || strlen($password) < 6) {
        echo "<script>alertify.error('La contraseña debe tener al menos 6 caracteres');</script>";
    }elseif ($password !== $confirmPassword) {
        echo "<script>alertify.error('Las contraseñas no coinciden');</script>";
    }else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $id = $decoded->sub ?? null;

        if (!$id) {
            echo "<script>alertify.error('ID de usuario no válido en el token');</script>";
            exit;
        }

   
        $sql = "UPDATE usuarios SET contrasenia = ? WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            echo "<script>alertify.error('Error al preparar consulta de contraseña');</script>";
            exit;
        }
        $stmt->bind_param('ss', $passwordHash, $id);

        if ($stmt->execute()) {
            echo "<script>alertify.success('Contraseña actualizada correctamente');</script>";
            $stmt->close();

      
            $sql = "UPDATE tokens SET estado = 0 WHERE token = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('s', $token);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "<script>alertify.error('Error al actualizar la contraseña');</script>";
        }

        $conexion->close();
    }
}
?>
