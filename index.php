<?php require_once __DIR__. '/conexion/conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./estilos/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="https://i.postimg.cc/Bv4bSbnx/logo.webp" type="image/x-icon">
    <title>Menu Inicial</title> 
</head>
<body>
   
<div class="top-banner d-none d-md-block">
<div class="marquee">
    <span><b>Bienvenido a Korean-Food la mejor experiencia de comida coreana en Perú 🇰🇷✨</span>
</div>
</div>
    <!-- ======= HEADER ======= -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container-fluid px-4">
    
        <a class="navbar-brand" href="#">
        <img src="https://i.postimg.cc/Ph866nvv/7734086.jpg" alt="Logo" class="logo-header">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
        <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse justify-content-between" id="menu">
        <ul class="navbar-nav ms-auto me-4 text-uppercase">
            <li class="nav-item"><a class="nav-link" href="/index.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="/nosotros.php">Nosotros</a></li>
            <li class="nav-item"><a class="nav-link" href="/carrito.php"><i class="bi bi-cart-plus"></i> mi pedido</a></li>
            <li class="nav-item"><a class="nav-link" href="/login/login.php"><i class="bi bi-person-add"></i></a></li>
        </ul>

        <form method="GET" action="">
            <select class="form-select border-danger text-danger fw-semibold" 
                    name="categoria" 
                    onchange="this.form.submit()" 
                    required 
                    style="max-width: 250px; font-size: 0.9rem;">
              <option value=""> Filtrar por categoría </option>
              <?php
              $catQuery = "SELECT id, nombre FROM categorias";
              $resultCat = $conexion->query($catQuery);
              while ($cat = $resultCat->fetch_assoc()) {
                  $selected = (isset($_GET['categoria']) && $_GET['categoria'] == $cat['id']) ? 'selected' : '';
                  echo "<option value='{$cat['id']}' $selected>{$cat['nombre']}</option>";
              }
              ?>
            </select>  
          </form>
      </div>
    </div>
</nav>
    <!-- ======= SECCIÓN PRINCIPAL ======= -->
  <section class="hero-section">
      <div class="container">
          <?php
              include ("./componentes/test.php");
          ?>
      </div>
  </section>

    <!-- ======= FOOTER ======= -->
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
          <li><a href="/index.php">Inicio</a></li>
          <li><a href="/carrito.php">Mi Pedido</a></li>
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
<script>
    document.querySelectorAll('.forAgregar').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('componentes/agregar.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'ok') {
                     alertify.success(data.mensaje) 
                } else {
                    alert('Error: ' + data.mensaje);
                }
            })
            .catch(() => {
                alert('Error de red o servidor');
            });
        });
    });
</script>
</html>

