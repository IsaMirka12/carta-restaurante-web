<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="https://i.postimg.cc/Bv4bSbnx/logo.webp" type="image/x-icon">
    <title>Carrito de compras</title> 
</head>
<body class="d-flex flex-column min-vh-100">
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
            <li class="nav-item"><a class="nav-link" href="/index.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="/nosotros.php">Nosotros</a></li>
            <li class="nav-item"><a class="nav-link" href="/carrito.php"><i class="bi bi-cart-plus"></i> mi pedido</a></li>
            <li class="nav-item"><a class="nav-link" href="/login/login.php"><i class="bi bi-person-add"></i></a></li>
        </ul>
        </div>
    </div>
    </nav>
   <div>
    <?php
     include ('./conexion/conexion.php');
     ?>
   </div>
  <main class=" flex-grow-1">
    <<section class="hero-section py-5">
        <div class="container">
            <div id="contenedor">
                <?php
                        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                ?>
                        <table class="table table-danger" id="productos">
                            <thead>
                                <tr>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                            $total=0;
                            foreach ($_SESSION['carrito'] as $producto) { ?>
                            <tr>
                                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                <input type="hidden" id="precio<?php echo $producto['id']; ?>" value="<?php echo $producto['precio']; ?>">
                                <td><input type="number" class="form-control text-center p-1 contCantidad"
                                    id="<?php echo "cantidad".$producto['id']; ?>"
                                    data-id="<?php echo $producto['id'];?>" style="width: 60px; height: 40px;"
                                    value="<?php echo $producto['cantidad']; ?>" min="0"></td>
                                <td> <?php echo $producto['nombre']; ?> </td>
                                <td> <img src='<?php echo $producto['imagen']; ?> ' class="img-thumbnail" style="width: 80px; height: 80px" alt="imagen pequeña" >  </td>
                                <td> <?php echo $producto['precio']; ?>  </td>
                                <td>  <input type='number' disabled class="form-control text-end" id="<?php echo "subtotal".$producto['id']; ?>" value="<?php echo $producto['precio'] * $producto['cantidad']; ?>" > </td>
                            </tr>
                            <?php $total=$total+($producto['precio'] * $producto['cantidad']); ?>
                        <?php    }
                    
                        } else {

                        ?>
                           <div class="d-flex flex-column justify-content-center align-items-center" style="min-height: 60vh;">
                                <i class="bi bi-cart-x display-1 text-muted"></i>
                                <p class="fs-4 mt-3">El carrito está vacío.</p>
                            </div>
                        <?php }
                    ?>    
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end align-items-center my-3">
                <h2 class="me-3">Total</h2>
                <input type="number" id="total" class="form-control text-end" disabled style="width: 150px;" value="<?php echo $total ?? 0; ?>">
            </div>
            <form class="forAgregarPedido">
                <input type="hidden" name="id"     value="<?= $producto['id']; ?>">
                <input type="hidden" name="precio" value="<?= $producto['precio']; ?>">
                <input type="hidden" name="total" value="<?php $total=$total+($producto['precio'] * $producto['cantidad']); ?>">
                <input type="hidden" name="cantida" value="<?= $producto['cantidad'] ?>">
                <?php
                    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) { ?>
                        <button type="submit" 
                            class='btn btn-danger btn-sm w-50 fw-semibold rounded-pill shadow-sm btn-agregar-pedido'>
                            Confirmar Pedido 
                        </button>
                <?php  } ?>

            </form>
        </div>
        </section>
  </main>

<footer class="footer-custom mt-auto">
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
    inicializarEventos();
    function inicializarEventos() {
        document.querySelectorAll('.contCantidad').forEach(input => {
            input.addEventListener('change', function () {
                console.log('entroo');
                const idProducto = this.dataset.id;
                const nuevaCantidad = parseInt(this.value);
                console.log(nuevaCantidad);
            
                if (nuevaCantidad && nuevaCantidad <= 0 ) {

                    alertify.confirm('¿Desea eliminar el producto?', 'Esta acción es irreversible, se eliminará el producto', 
                    function(){ 
                        modificarCantidad(idProducto, nuevaCantidad);
                    }
                    , function(){
                        alertify.error('No se eliminó el producto');
                        const precio = document.getElementById("precio"+idProducto).value;
                        const subtotal = document.getElementById("subtotal"+idProducto).value;
                        console.log("precio", precio)
                        console.log("subtotal", subtotal)
                        const cantidad = subtotal / precio;
                        document.getElementById("cantidad"+idProducto).value = cantidad;
                        return
                    });
                    return
                } else if(nuevaCantidad){
                    modificarCantidad(idProducto, nuevaCantidad);
                } else {
                    alertify.error("Cantidad invalida") 
                }
                
            })
        });
    }

    function modificarCantidad(idProducto, nuevaCantidad){
        fetch('./carrito/modificarCantidad.php',{
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${idProducto}&cantidad=${nuevaCantidad}`
            })
            .then( res => res.json())
            .then( data => {
                if (data.status === 'ok') {
                   console.log('actualizada');
                   document.getElementById(`subtotal${idProducto}`).value = data.subtotal;
                   document.getElementById('total').value = data.total;
                    let contenedor = `
                    <table class="table table-danger" id="productos">
                    <thead>
                        <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    `;
                    for (const producto of data.productos) {
                        contenedor+=  `
                        <tr>
                            <input type="hidden" name="id" value="${producto.id}">
                            <input type="hidden" id="precio${producto.id}" value="${producto.precio}">
                            <td><input type="number" class="form-control text-center p-1 contCantidad"
                                id="cantidad${producto.id}"
                                data-id="${producto.id}" style="width: 60px; height: 40px;"
                                value="${producto.cantidad}" min="0"></td>
                            <td> ${producto.nombre} </td>
                            <td> <img src='${producto.imagen}' class="img-thumbnail" style="width: 80px; height: 80px" alt="${producto.nombre}" >  </td>
                            <td> ${producto.precio}  </td>
                            <td>  <input type='number' class="form-control text-end" disabled id="subtotal${producto.id}" value="${producto.cantidad * producto.precio}" > </td>
                        </tr>
                    `
                    }
                    
                    contenedor += `
                        </tbody>
                    </table>
                    `;
                    
                    document.getElementById("contenedor").innerHTML = contenedor;
                    inicializarEventos();
                    alertify.success(data.mensaje) 
                }else{
                    alert(data.mensaje);
                }
            })
            .catch(err => {
                console.error('Error en la solicitud:', err);
            })
    }


    // document.querySelector('.forAgregarPedido').addEventListener('submit', function (e) {
    //     e.preventDefault();
    //     alertify.confirm(
    //     'Confirmar pedido',
    //     '¿Estás seguro de enviar el pedido?',
    //     function () {
    //         fetch('./carrito/registrarPedido.php', {
    //             method: 'POST'
    //         })
    //         .then(res => res.json())
    //         .then(data => {
    //             if (data.status === 'ok') {
    //                 alertify.success(data.mensaje);
    //                 let contenedor = `<h1>Carrito Vacío</h1>`;
    //                 document.getElementById("contenedor").innerHTML = contenedor;
    //                 document.getElementById("total").value = 0;
    //                 enviarPedidoWhatsap(data.productBd);
    //             } else {
    //                 alertify.error(data.mensaje);
    //             }
    //         })
    //         .catch(err => {
    //             console.error('Error en el registro del pedido:', err);
    //             alertify.error('Error al registrar el pedido');
    //         });
    //     },
    //     function () {
    //         alertify.error('Pedido cancelado');
    //         }
    //     );
    // });

document.querySelector('.forAgregarPedido').addEventListener('submit', function (e) {
  e.preventDefault();

  const usuarioLogueado = <?= (isset($_SESSION['usuario_id']) && $_SESSION['rol'] === 'cliente') ? 'true' : 'false' ?>;

    if (!usuarioLogueado) {
    alertify.alert("Inicia sesión", "Necesitas estar logueado como cliente para confirmar el pedido.", function () {
        window.location.href = "/login/login.php";
    });
    return;
    }
  alertify.confirm(
    'Confirmar pedido',
    '¿Estás seguro de enviar el pedido?',
    function () {
      fetch('./carrito/registrarPedido.php', {
        method: 'POST'
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'ok') {
          alertify.success(data.mensaje);
          document.getElementById("contenedor").innerHTML = `<h1>Carrito Vacío</h1>`;
          document.getElementById("total").value = 0;
          enviarPedidoWhatsap(data.productBd);
        } else {
          alertify.error(data.mensaje);
        }
      })
      .catch(err => {
        console.error('Error en el registro del pedido:', err);
        alertify.error('Error al registrar el pedido');
      });
    },
    function () {
      alertify.error('Pedido cancelado');
    }
  );
});



    function enviarPedidoWhatsap(productos) {
        if (!Array.isArray(productos) || productos.length === 0) {
            alertify.error("No hay productos para enviar por WhatsApp");
            return;
        }

        const pedido = productos[0];

        let mensaje = `*Nuevo Pedido*%0A` +
                    `Pedido: ${pedido.numeroPedido}%0A` +
                    `Pago: ${pedido.metodo_pago}%0A` +
                    `Estado: ${pedido.estado}%0A%0A` +
                    `*Productos:*%0A`;

        let total = 0;

        productos.forEach(prod => {
            mensaje += `• ${prod.nombre} x ${prod.cantidad} - S/. ${prod.precio_unitario}%0A`;
            total += parseFloat(prod.precio_unitario) * parseInt(prod.cantidad);
        });

        mensaje += `%0A Total: *S/. ${total.toFixed(2)}*`;

        const numero = "51987752530";
        const url = `https://wa.me/${numero}?text=${mensaje}`;
        window.open(url, '_blank');
    }





</script>

</html>

