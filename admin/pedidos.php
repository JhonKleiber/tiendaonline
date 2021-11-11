<?php include("template/adminheader.php"); ?>
<?php include("config/conexion.php"); ?>
<?php 
#Preparamos la sentencia para mostrar el detalle pedido organizado por fecha. Por defecto se organizan por fecha.
$consultaSQL= $conexion->prepare("SELECT * FROM pedidos");
$consultaSQL->execute();
#Usamos fetchAll para que nos devuelva un array con todas las filas de los resultados y fetch_assoc, nos asocia los datos de la tabla.
$pedidos=$consultaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
        <h1 class="display-3 mt-5 text-center">Detalles pedido</h1>
        <div class="col-md-12 mt-5">
                <table class="table table-hover table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th>N_Pedido</th>
                            <th>Produto_ID</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($pedidos as $pedido) { ?>
                        <tr>
                            <td><?php echo $pedido['n_pedido']; ?></td>
                            <td><?php echo $pedido['producto_id']; ?></td>
                            <td><?php echo $pedido['nombre_producto']; ?></td>
                            <td><?php echo $pedido['precio_producto']; ?></td>
                            <td><?php echo $pedido['fecha']; ?></td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
            </div>

<?php 
#Agrupamos pedidos por precio total descendente y los mostramos
$consultaSQL= $conexion->prepare("SELECT n_pedido,fecha,SUM(precio_producto) as precio_total FROM pedidos GROUP BY n_pedido ORDER BY precio_total DESC");
$consultaSQL->execute();
#Usamos fetchAll para que nos devuelva un array con todas las filas de los resultados y fetch_assoc, nos asocia los datos de la tabla.
$pedidos=$consultaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
            <h1 class="display-3 mt-5 text-center">Pedidos ordenados por total</h1>
            <div class="col-md-12 mt-5">
                <table class="table table-hover table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th>N_Pedido</th>
                            <th>Precio total</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($pedidos as $pedido) { ?>
                        <tr>
                            <td><?php echo $pedido['n_pedido']; ?></td>
                            <td><?php echo $pedido['fecha']; ?></td>
                            <td><?php echo $pedido['precio_total']; ?></td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
            </div>
<?php include("template/adminfooter.php"); ?>