<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../../miProyecto/login/login.php");
    exit;
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
    <title>Panel Administrador</title> 
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
        <li class="nav-item"><a class="nav-link" href="/miProyecto/index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="/miProyecto/nosotros.php">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="/miProyecto/carrito.php"><i class="bi bi-cart-plus"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="/miProyecto/login/login.php"><i class="bi bi-person-add"></i></a></li>
    </ul>

    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
      Agregar Producto
    </button>
</div>
</nav>
<section class="hero-section">
    <div class="container">
    <h2 class="mb-4 text-center">Lista de Productos</h2>
    <?php 
    include '../conexion/conexion.php';

    $sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen, c.nombre AS categoria
            FROM productos p
            INNER JOIN categorias c ON p.categoria_id = c.id
            WHERE p.estado = 1";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $conexion->close();
    ?>
    <table class="table table-bordered table-striped table-hover table-primary text-center align-middle shadow rounded">
        <thead class="table-dark">
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio</th>
            <th scope="col">Imagen</th>
            <th scope="col">Categoría</th>
            <th scope="col">Opciones</th>
        </tr>
        </thead>
        <tbody>
            <?php  foreach ($resultado as $producto) {  ?>
                <tr>
                <td scope="row"> <?php echo str_pad($producto["id"], 5, "0", STR_PAD_LEFT); ?> </td>
                <td> <?php echo $producto["nombre"]; ?> </td>
                <td> <?php echo $producto["descripcion"]; ?> </td>
                <td> <?php echo $producto["precio"]; ?> </td>
                <td> <img src="<?php echo $producto["imagen"]; ?>" class="img-thumbnail" style="width: 80px; height: 80px" alt="imagen pequeña"  ></td>
                <td> <?php echo $producto["categoria"]; ?> </td>
                <td>
                <button  class="btn btn-link text-primary p-0 me-2"  data-bs-toggle="modal" data-bs-target="#modalProductos"  
                        onclick="editarProducto(<?php echo $producto['id']; ?>)"  title="Editar">
                    <i class="bi bi-pencil-square fs-5"></i>
                </button>
                <button class="btn btn-link text-danger p-0 eliminarProd" onclick="eliminarProducto(<?php echo $producto['id']; ?>)" title="Eliminar">
                    <i class="bi bi-trash3 fs-5"></i>
                </button>

                </td>   
                </tr>         
            <?php } ?>
        </tbody>
    </table>
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

<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      
      <div class="modal-body">
        <form id="formEditarProducto">
          <input type="hidden" id="idProducto">
          <div class="mb-3">
            <label for="nombre" class="col-form-label">Nombre Producto:</label>
            <input type="text" class="form-control" id="nombre">
          </div>
          <div class="mb-3">
            <label for="descripcion" class="col-form-label">Descripción:</label>
            <textarea class="form-control" id="descripcion" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="precio" class="col-form-label">Precio:</label>
            <input type="number" class="form-control" id="precio" step="0.01">
          </div>
          <div class="mb-3">
            <label for="imagen" class="col-form-label">URL de la imagen:</label>
            <input type="text" class="form-control" id="imagen">
            <img id="preview-imagen" src="" alt="Vista previa" class="img-thumbnail mt-2" style="max-height: 150px;">
          </div>
          <div class="mb-3">
            <label for="categoria" class="col-form-label">Categoría:</label>
            <select class="form-select" id="categoria">
            <option value="">Seleccione una categoría</option>
            <option value="Dopab">Dopab</option>
            <option value="Ramyeon">Ramyeon</option>
            <option value="Rice">Rice</option>
            <option value="Guarnición">Guarnición</option>
            <option value="Bebidas">Bebidas</option>
            </select>
          </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnGuardar" onclick="guardarProductoEditado()" >Aceptar</button>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="modalAgregarProducto" tabindex="-1" aria-labelledby="agregarProductoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formAgregarProducto">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarProductoLabel">Agregar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nuevo-nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nuevo-nombre" required>
          </div>
          <div class="mb-3">
            <label for="nuevo-descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="nuevo-descripcion" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="nuevo-precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="nuevo-precio" step="0.01" min="1" required>
          </div>
          <div class="mb-3">
            <label for="nuevo-imagen" class="form-label">URL Imagen</label>
            <input type="text" class="form-control" id="nuevo-imagen" required>
            <img id="preview-nueva-imagen" class="img-thumbnail mt-2" style="max-height: 150px;">
          </div>
          <div class="mb-3">
            <label for="nuevo-categoria" class="form-label">Categoría</label>
            <select id="nuevo-categoria" class="form-select" required>
              <option value="">Seleccione una categoría</option>
              <option value="Dopab">Dopab</option>
              <option value="Ramyeon">Ramyeon</option>
              <option value="Rice">Rice</option>
              <option value="Guarnición">Guarnición</option>
              <option value="Bebidas">Bebidas</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
</body>
</html>

<script>

    function eliminarProducto(id) {
        alertify.confirm("¿Estás seguro de eliminar este producto?",
        function () {
            fetch(`eliminarProducto.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alertify.success('Producto eliminado');
                    // Opcional: eliminar la fila de la tabla
                    location.reload();
                } else {
                    alertify.error('Error al eliminar');
                }
            });
        },
        function () {
            alertify.error('Cancelado');
        });
    }

function editarProducto(id) {
    fetch(`obProductoId.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const producto = data.producto;
                document.getElementById('idProducto').value = id;
                document.getElementById('nombre').value = producto.nombre;
                document.getElementById('descripcion').value = producto.descripcion;
                document.getElementById('precio').value = producto.precio;
                document.getElementById('imagen').value = producto.imagen;
                document.getElementById('preview-imagen').src = producto.imagen;
                document.getElementById('categoria').value = producto.categoria;
            } else {
                alertify.error('Error al obtener el producto');
            }
        })
        .catch(error => {
            console.error('Error en la petición:', error);
            alertify.error('Fallo al conectar con el servidor');
        });
}

  const inputImagen = document.getElementById('imagen');
  const preview = document.getElementById('preview-imagen');
  inputImagen.addEventListener('input', function () {
      preview.src = inputImagen.value;
  });
   function obtenerIndiceSeleccionado() {
        const select = document.getElementById("categoria");
        const indice = select.selectedIndex;
        return indice; 
    }

async function guardarProductoEditado() {
    const idProducto = document.getElementById('idProducto').value;
    
    if (!idProducto) {
        alertify.error('ID del producto no encontrado');
        console.error('ID del producto es undefined');
        return;
    }

    const data = {
        idProducto: idProducto,
        nombre: document.getElementById('nombre').value,
        descripcion: document.getElementById('descripcion').value,
        precio: document.getElementById('precio').value,
        imagen: document.getElementById('imagen').value,
        categoria: obtenerIndiceSeleccionado(),
    };

    try {
        const response = await fetch('editarProducto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        if (result.success) {
            alertify.success('Producto actualizado');
                 setTimeout(() => {
                  location.reload();
              }, 2000);
            // location.reload();
        } else {
            alertify.error('Error al actualizar');
        }
    } catch (error) {
        console.error('Error en la petición:', error);
        alertify.error('Fallo al conectar con el servidor');
    }
}

document.getElementById('nuevo-imagen').addEventListener('input', function () {
    document.getElementById('preview-nueva-imagen').src = this.value;
});

document.getElementById('formAgregarProducto').addEventListener('submit', async function (e) {
    e.preventDefault();

    const data = {
        nombre: document.getElementById('nuevo-nombre').value,
        descripcion: document.getElementById('nuevo-descripcion').value,
        precio: parseFloat(document.getElementById('nuevo-precio').value),
        imagen: document.getElementById('nuevo-imagen').value,
        categoria: document.getElementById('nuevo-categoria').value
    };

    try {
        const response = await fetch('agregarProducto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        if (result.success) {
            alertify.success("Producto agregado correctamente");
              setTimeout(() => {
                  location.reload();
              }, 2000);
        
        } else {
            alertify.error("Error: " + result.error);
        }
    } catch (error) {
        console.error('Error al conectar con el servidor:', error);
        alertify.error("No se pudo agregar el producto");
    }
});

</script>
