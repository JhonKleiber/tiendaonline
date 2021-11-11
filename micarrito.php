<?php include("template/header.php"); ?>
            <div class="p-5 mt-5 mb-5 text-center">
                <div class="container">
                    <h1 class="display-3 mt-5">Mi carrito</h1>
                    <?php
                        session_start();
                        if(empty($_SESSION)){
                            echo "<h2>No has agregado ningún producto al carrito.</h2>";
                        }else { ?>
                            <div class="col-md-12 mt-5">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-info">
                                        <tr>
                                            <th>Producto</th>
                                            <th class="d-none">ID</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($_SESSION as $disco) { ?>
                                            <tr>
                                                <td>
                                                    <img class="img-thumbnail rounded" src="img/<?php echo $disco[3]; ?>" width="60" alt="">
                                                </td>
                                                <td class="d-none"><?php echo $disco[0]; ?></td>
                                                <td><?php echo $disco[1]; ?></td>
                                                <td><?php echo $disco[2]; ?></td>
                                            </tr>
                                        <?php }; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="container text-end">
                                <?php
                                $discototal=0.00; 
                                foreach($_SESSION as $disco) {
                                #echo "$disco[2]"."<br/>";
                                $discototal=(float)$disco[2]+(float)$discototal;
                                }; ?>
                                <h3>Total: <?php echo $discototal;?>&#128;</h3>    
                            </div>
                            <a class="btn btn-danger" href="vaciarcarrito.php" role="button">Vaciar carrito</a>
                            <a class="btn btn-primary" href="hacerpedido.php" role="button">Hacer pedido</a>
                        <?php }; ?>
                </div>
            </div>
<?php include("template/footer.php"); ?>