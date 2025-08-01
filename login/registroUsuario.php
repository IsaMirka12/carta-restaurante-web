<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../estilos/styles.css">
    <title>Registrar Usuario</title> 
</head>
<body>
<div class="top-banner d-none d-md-block">
<div class="marquee">
    <span><b>Bienvenido a Korean-Food la mejor experiencia de comida coreana en Perú 🇰🇷✨</span>
</div>
</div>
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
<div class="container-fluid px-4">
    <a class="navbar-brand" href="miProyecto/index.php">
    <img src="https://i.postimg.cc/Ph866nvv/7734086.jpg" alt="Logo" class="logo-header">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="menu">
    <ul class="navbar-nav ms-auto me-4 text-uppercase">
        <li class="nav-item"><a class="nav-link" href="/miProyecto/index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="/miProyecto/nosotros.php">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="/miProyecto/carrito.php"><i class="bi bi-cart-plus"></i> Mis pedidos</a></li>
        <li class="nav-item"><a class="nav-link" href="/miProyecto/login/login.php"><i class="bi bi-person-add"></i></a></li>
    </ul>
    </div>
</div>
</nav>
<section class="hero-section">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 text-center">
        <h1 class="display-4 fw-bold" style="color: var(--rojo-oscuro);">Registro de Usuario</h1>
        <p class="lead" style="color: var(--rojo-claro);">Ingrese sus datos completos</p>
        </div>
    </div>
  </div>

    <form class="needs-validation d-flex flex-column align-items-center gap-3 w-100" method="POST" action="" novalidate>
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label fw-semibold" style="color: var(--rojo-oscuro);">Nombres</label>
        <input type="text" class="form-control border-danger" id="validationCustom01" name="nombres" required>
        <div class="valid-feedback">Perfecto</div>
    </div>

    <div class="col-md-4">
        <label for="validationCustom02" class="form-label fw-semibold" style="color: var(--rojo-oscuro);">Apellidos</label>
        <input type="text" class="form-control border-danger" id="validationCustom02" name="apellidos" required>
        <div class="valid-feedback">Perfecto</div>
    </div>

    <div class="col-md-4">
        <label for="validationCustomUsername" class="form-label fw-semibold" style="color: var(--rojo-oscuro);">Correo Electrónico</label>
        <div class="input-group has-validation">
        <span class="input-group-text bg-danger text-white border-danger" id="inputGroupPrepend">@</span>
        <input type="email" class="form-control border-danger" name="correo" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">Por favor ingrese su correo.</div>
        </div>
    </div>

    <div class="col-md-4 text-center">
        <button class="btn fw-semibold w-100" type="submit"
                style="background-color: var(--rojo-oscuro); color: var(--blanco);">
        Enviar Formulario
        </button>
    </div>
    </form>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

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
</body>
</html>

<?php 
  include('../conexion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['nombres'], $_POST['apellidos'], $_POST['correo'])) {
        echo "<script>alertify.error('Faltan datos del formulario.');</script>";
        return;
    }

    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);

    if (empty($nombres) || empty($apellidos) || empty($correo)) {
        echo "<script>alertify.error('Todos los campos son obligatorios.');</script>";
        return;
    }

    if (strlen($nombres) < 2 || strlen($apellidos) < 2) {
        echo "<script>alertify.error('Nombres y apellidos deben tener al menos 2 caracteres.');</script>";
        return;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alertify.error('Correo no válido.');</script>";
        return;
    }

    $sql = "SELECT id FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        echo "<script>alertify.error('Error al preparar verificación: {$conexion->error}');</script>";
        return;
    }
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "<script>alertify.error('El correo ya está registrado.');</script>";
        $stmt->close();
        return;
    }
    $stmt->close();

    $sql = "INSERT INTO usuarios (nombres, apellidos, correo) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        echo "<script>alertify.error('Error al preparar inserción: {$conexion->error}');</script>";
        return;
    }
    $stmt->bind_param("sss", $nombres, $apellidos, $correo);

    if ($stmt->execute()) {
        echo "<script>alertify.success('Sus datos se registraron correctamente');</script>";
    } else {
        echo "<script>alertify.error('Error al registrarse, inténtelo nuevamente');</script>";
    }
    $stmt->close();

    $sql = "SELECT id, correo, nombres, apellidos FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $idUsuario = $fila['id'];
        $correoObt = $fila['correo'];
        $nombreObt = $fila['nombres'];
        $apellidoObt = $fila['apellidos'];
    }
    $stmt->close();

    require '../login/crearToken.php';
    $tokenGenerado = registrarUsuario($idUsuario);

    if (!$tokenGenerado) {
        echo "<script>alertify.error('Error al generar el token.');</script>";
        return;
    }

    $sql = "INSERT INTO tokens (usuario_id, token) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        echo "<script>alertify.error('Error al preparar inserción del token: {$conexion->error}');</script>";
        return;
    }
    $stmt->bind_param("ss", $idUsuario, $tokenGenerado);
    $stmt->execute();
    $stmt->close();
    $conexion->close();

    require '../libs/PHPMailer/src/Exception.php';
    require '../libs/PHPMailer/src/PHPMailer.php';
    require '../libs/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'isa023bel@gmail.com';
        $mail->Password   = 'zvrdhrwsrtafqxcg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('isa023bel@gmail.com', 'Maria Isabel');
        $mail->addAddress($correoObt, $nombreObt . ' ' . $apellidoObt);

        $mail->isHTML(true);
        $mail->Subject = 'Para continuar con tu Registro';
        $mail->Body    = '
            <h2>Hola ' . htmlspecialchars($nombreObt) . '!</h2>
            <p>Gracias por registrarte. Haz clic en el siguiente enlace para continuar:</p>
            <a href="http://miproyecto.test/login/confimarContrasenia.php?token=' . urlencode($tokenGenerado) . '">Confirmar Registro</a>
        ';

        $mail->send();
    } catch (Exception $e) {
        echo "<script>alertify.error('No se pudo enviar el correo. Error: {$mail->ErrorInfo}');</script>";
    }
}
?>
