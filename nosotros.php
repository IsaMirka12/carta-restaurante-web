<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./estilos/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>Nosotros</title> 
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
          <li class="nav-item"><a class="nav-link" href="/miProyecto/index.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="/miProyecto/nosotros.php">Nosotros</a></li>
          <li class="nav-item"><a class="nav-link" href="/miProyecto/carrito.php"><i class="bi bi-cart-plus"></i> mi pedido</a></li>
          <li class="nav-item"><a class="nav-link" href="../miProyecto/login/login.php"><i class="bi bi-person-add"></i></a></li>
      </ul>
      </div>
    </div>
</nav>
<section id="nosotros" class="position-relative text-white" style="background-image: url('https://i.postimg.cc/ZnFZLwgF/kimchi-bokkumbab.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(134, 117, 117, 0.88); z-index: 1;"></div>
  <div class="container py-5 position-relative" style="z-index: 2;">
    <div class="row align-items-center g-5">

      <div class="col-lg-6">
        <h2 class="fw-bold mb-4 display-5 text-uppercase"  style="color: #9e1b1b;">Sobre Nosotros</h2>
        <p class="fs-5 mb-4 text-light">
          En <strong  style="color: #9e1b1b;">Korean_food</strong> llevamos a tu paladar la verdadera esencia de Corea. Nuestros platos combinan tradición, frescura y amor por la cultura.
        </p>
        <ul class="list-unstyled fs-5 mb-4">
          <li class="mb-2"><i class="bi bi-check-circle-fill me-2"  style="color: #9e1b1b;"></i> Ingredientes auténticos</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill  me-2"  style="color: #9e1b1b;"></i> Cocina hecha con pasión</li>
          <li class="mb-2"><i class="bi bi-check-circle-fill  me-2"  style="color: #9e1b1b;"></i> Atención cálida y rápida</li>
        </ul>
        <div class="d-flex flex-wrap gap-3">
          <a href="https://instagram.com" target="_blank" class="btn btn-outline-warning1 text-white rounded-pill px-4 py-2">
            <i class="bi bi-instagram me-2"></i> Instagram
          </a>
          <a href="https://facebook.com" target="_blank" class="btn btn-outline-primary text-white rounded-pill px-4 py-2">
            <i class="bi bi-facebook me-2"></i> Facebook
          </a>
          <a href="https://wa.me/51999999999" target="_blank" class="btn btn-outline-success text-white rounded-pill px-4 py-2">
            <i class="bi bi-whatsapp me-2"></i> WhatsApp
          </a>
        </div>
      </div>
      <div class="col-lg-6 text-center">
        <img src="https://i.postimg.cc/X7SpchZF/donkasu-queso.webp" class="img-fluid rounded-4 shadow-lg animate__animated animate__zoomIn" alt="Donkasu con queso" style="max-height: 420px; object-fit: cover; border: 4px solid rgba(255, 255, 255, 0.2);">
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
          <li><a href="/miProyecto/index.php">Inicio</a></li>
          <li><a href="/miProyecto/carrito.php">Mi Pedido</a></li>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
</body>
</html>
