<?php
session_start();

$productosPorPagina = 8;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $productosPorPagina;

$categoriaFiltrada = isset($_GET['categoria']) ? $_GET['categoria'] : null;

if ($categoriaFiltrada) {
    $sqlTotal = "SELECT COUNT(*) as total FROM productos WHERE categoria_id = ? AND estado = 1";
    $stmtTotal = $conexion->prepare($sqlTotal);
    $stmtTotal->bind_param("i", $categoriaFiltrada);
    $stmtTotal->execute();
    $total = $stmtTotal->get_result()->fetch_assoc()['total'];

    $sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen
            FROM productos p
            WHERE p.categoria_id = ? AND p.estado = 1
            LIMIT ? OFFSET ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iii", $categoriaFiltrada, $productosPorPagina, $offset);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $total = $conexion->query("SELECT COUNT(*) as total FROM productos WHERE estado = 1")->fetch_assoc()['total'];

    $sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen
            FROM productos p
            WHERE p.estado = 1
            LIMIT $productosPorPagina OFFSET $offset";
    $resultado = $conexion->query($sql);
}

$totalPaginas = ceil($total / $productosPorPagina);
?>

<div class="container py-4">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    <?php
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
    ?>
    <div class="col">
      <div class="card h-100 shadow-sm border-0 rounded-4 mx-auto" style="max-width: 16rem;">
        <img src="<?= $fila['imagen']; ?>"
             class="card-img-top rounded-top"
             style="height: 180px; object-fit: cover;"
             alt="Imagen de producto">
        <div class="card-body d-flex flex-column text-center px-3">
          <h5 class="card-title text-danger fw-bold mb-2"><?= $fila["nombre"]; ?></h5>
          <p class="card-text text-muted flex-grow-1 small"><?= $fila["descripcion"]; ?></p>
          <p class="card-text fw-semibold text-success fs-6 mt-2 mb-3">S/ <?= $fila["precio"]; ?></p>

          <form class="forAgregar mt-auto" method="post">
            <input type="hidden" name="id" value="<?= $fila['id'] ?>">
            <input type="hidden" name="precio" value="<?= $fila['precio'] ?>">
            <button type="submit" class="btn btn-outline-danger btn-sm w-100 fw-semibold">
              Agregar
            </button>
          </form>
        </div>
      </div>
    </div>
    <?php
        }
    } else {
        echo "<p class='text-center'>No se encontraron productos.</p>";
    }
    ?>
  </div>
</div>

<?php if ($totalPaginas > 1): ?>
<nav aria-label="Page navigation" class="mt-4">
  <ul class="pagination justify-content-center">
    <?php if ($paginaActual > 1): ?>
      <li class="page-item">
        <a class="page-link"
           style="color: #9e1b1b; border-color: #9e1b1b;"
           href="?pagina=<?= $paginaActual - 1 ?><?= $categoriaFiltrada ? '&categoria=' . $categoriaFiltrada : '' ?>">Anterior</a>
      </li>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
        <a class="page-link"
           href="?pagina=<?= $i ?><?= $categoriaFiltrada ? '&categoria=' . $categoriaFiltrada : '' ?>"
           style="<?= ($i == $paginaActual)
             ? 'background-color: #9e1b1b; color: white; border-color: #9e1b1b;'
             : 'color: #9e1b1b; border-color: #9e1b1b;' ?>">
          <?= $i ?>
        </a>
      </li>
    <?php endfor; ?>

    <?php if ($paginaActual < $totalPaginas): ?>
      <li class="page-item">
        <a class="page-link"
           style="color: #9e1b1b; border-color: #9e1b1b;"
           href="?pagina=<?= $paginaActual + 1 ?><?= $categoriaFiltrada ? '&categoria=' . $categoriaFiltrada : '' ?>">Siguiente</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>

<?php endif; ?>

<?php $conexion->close(); ?>

<script>
const arrCarrito = [];

function agregarProducto(id, precio) {
  let cantidad = 1;
  let total = precio * cantidad;
  const producto = arrCarrito.find(p => p.id === id);

  if (producto) {
    producto.cantidad += 1;
    producto.total = producto.precio * producto.cantidad;
  } else {
    arrCarrito.push({
      id: id,
      precio: precio,
      cantidad: cantidad,
      total: total,
    });
  }
  return arrCarrito;
}
</script>
