<?php
session_start();

$busqueda = isset($_POST['buscar']) ? strtolower(trim($_POST['buscar'])) : '';
$total = 0;
ob_start();

?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Cantidad</th>
      <th>Nombre</th>
      <th>Imagen</th>
      <th>Precio</th>
      <th>Subtotal</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($_SESSION['carrito'] as $producto) {
      if ($busqueda !== '' &&
         strpos(strtolower($producto['nombre']), $busqueda) === false &&
         $producto['id'] != $busqueda) {
        continue;
      }
    ?>
      <tr>
        <td><input type="number" class="form-control text-center p-1"
                   value="<?php echo $producto['cantidad']; ?>" min="0" style="width:60px; height:40px;"></td>
        <td><?php echo $producto['nombre']; ?></td>
        <td><img src="<?php echo $producto['imagen']; ?>" class="img-thumbnail" style="width: 80px; height: 80px"></td>
        <td><?php echo $producto['precio']; ?></td>
        <td><?php echo $producto['precio'] * $producto['cantidad']; ?></td>
      </tr>
    <?php
      $total += $producto['precio'] * $producto['cantidad'];
    }

    if ($total === 0) {
      echo "<tr><td colspan='5' class='text-center'>No se encontraron productos.</td></tr>";
    }
    ?>
  </tbody>
</table>

<h5>Total: S/. <?php echo number_format($total, 2); ?></h5>

<?php
echo ob_get_clean();
