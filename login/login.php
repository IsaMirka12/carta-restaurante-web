

<?php 
include __DIR__.'/../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $sql = "SELECT id,nombres, contrasenia, rol FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        echo "<script>alertify.error('Error al preparar verificación: {$conexion->error}');</script>";
        return;
    }
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        if (password_verify($password, $usuario['contrasenia'])) {
            // Login correcto
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombres'];
            $_SESSION['rol'] = $usuario['rol'];
          if ($usuario['rol'] === 'admin') {
              header("Location: ../../miProyecto/administrador/principal.php");
          } else {
              header("Location: /miProyecto/carrito.php");
          }
          exit;
        } else {
            echo "<script>alertify.error('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alertify.error('El correo no está registrado');</script>";
    }
    $stmt->close();
    $conexion->close();
}
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
    <link rel="icon" href="https://i.postimg.cc/Bv4bSbnx/logo.webp" type="image/x-icon">
    <title>Iniciar sesión</title> 
</head>
<body>
  <div class="top-banner d-none d-md-block">
  <div class="marquee">
    <span><b>Bienvenido a Korean-Food la mejor experiencia de comida coreana en Perú 🇰🇷✨</span>
  </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container-fluid px-4">

    <a class="navbar-brand" href="../../miProyecto/index.php">
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
        <li class="nav-item"><a class="nav-link" href="/login.php"><i class="bi bi-person-add"></i></a></li>
    </ul>
    </div>
  </div>
  </nav>
  <section class="hero-section py-4" style="background-color: #ffede4;">
    <div class="container d-flex justify-content-center">
      <div class="card shadow-sm p-5 border-0" style="width: 100%; max-width: 500px; border-radius: 12px;">
        <h4 class="text-center mb-4 fw-bold text-danger">Iniciar Sesión</h4>
        <form method="POST" action="" novalidate>
          <div class="mb-3">
            <label for="email" class="form-label text-dark mb-1">Correo electrónico</label>
            <input type="email" class="form-control border-dark" id="email" name="email" required>
            <div class="invalid-feedback">Por favor, ingresa un correo válido.</div>
          </div>
          <div class="mb-4">
            <label for="password" class="form-label text-dark mb-1">Contraseña</label>
            <input type="password" class="form-control border-dark" id="password" name="password" required>
            <div class="invalid-feedback">La contraseña es obligatoria.</div>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-danger fw-semibold py-2 fs-6">Ingresar</button>
          </div>
          <div class="text-center">
            <a href="/registroUsuario.php" class="text-decoration-none small fw-semibold">¿No tienes cuenta?</a>
          </div>
        </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<script>
    (() => {
      'use strict';
      const forms = document.querySelectorAll('form');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
</script>
</body>
</html>
