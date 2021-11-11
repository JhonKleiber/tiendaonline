<?php include("template/header.php"); ?>
<?php include("admin/config/conexion.php");
#Nos conectamos a la base de datos incluyendo el archivo conexion con include. 
#Preparamos la sentencia para mostrar todos los discos
$consultaSQL= $conexion->prepare("SELECT * FROM lanzamientos");
#Ejecutamos la sentencia
$consultaSQL->execute();
#Usamos fetchAll para que nos devuelva un array con todas las filas de los resultados y fetch_assoc, nos asocia los datos de la tabla.
$listadiscos=$consultaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($listadiscos as $disco) { 
#Recorremos todo el array uno a uno con el foreach ?>
            <div class="col-md-3 mt-5 mb-5 container">
                <div class="card">
                    <img class="card-img-top" src="img/<?php echo $disco['imagen']; ?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $disco['nombre']; ?></h4>
                        <p class="card-text"><?php echo $disco['descripcion']; ?></p>
                        <p class="card-text"><?php echo $disco['precio']; ?>&#128;</p>
                        <p class="card-text d-none"><?php echo $disco['id']; ?></p>
                        <a name="" id="" class="btn btn-primary" href='carrito.php?id=<?php echo $disco['id']; ?>&nombre=<?php echo $disco['nombre']; ?>&precio=<?php echo $disco['precio']; ?>&imagen=<?php echo $disco['imagen']; ?>' role="button">Añadir al carrito</a>
                    </div>
                </div>  
            </div>
<?php }; ?>
<?php include("template/footer.php"); ?>
