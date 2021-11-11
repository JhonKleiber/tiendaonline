<?php include("template/adminheader.php"); ?>
<?php 
#$textoID=(isset($_REQUEST['id']))?$_REQUEST['id']:""; Validamos la información. 
#Lo que hay dentro del parentesis es el dato que queremos validar.
#Si la condicion se cumple entonces realizaremos la acción que está después del ?(then).
#Si no se cumple la condicion entonces realizaremos la acción que está después de los :(else).
#isset nos indica si existe lo del parentesis.
#Establecemos las variables
$id=(isset($_REQUEST['id']))?$_REQUEST['id']:"";
$nombre=(isset($_REQUEST['nombre']))?$_REQUEST['nombre']:"";
$descripcion=(isset($_REQUEST['descripcion']))?$_REQUEST['descripcion']:"";
$precio=(isset($_REQUEST['precio']))?$_REQUEST['precio']:"";
$imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
$accion=(isset($_REQUEST['accion']))?$_REQUEST['accion']:"";

include("config/conexion.php");

#La sentencia switch es parecido a una serie de sentencias if anidadas.
#Evaluamos con un switch lo que pulsa el usuario.
switch($accion){

    case "Agregar":
        #Contruimos la sentencia SQL.
        $consultaSQL= $conexion->prepare("INSERT INTO lanzamientos (nombre,descripcion,precio,imagen) VALUES (:nombre,:descripcion,:precio,:imagen);");
        #indicamos los parametros que vamos a sustituir y porque variables lo haremos.
        $consultaSQL->bindParam(':nombre',$nombre);
        $consultaSQL->bindParam(':descripcion',$descripcion);
        $consultaSQL->bindParam(':precio',$precio);
        #Si subimos una imagen ponemos un nombre con la fecha por delante. Si no se sube imagen, ponemos una imagen alternativa.
        $fecha= new DateTime();
        $nombrearchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
        $tmpimagen=$_FILES["imagen"]["tmp_name"];
        #si la imagen no esta vacia, la subimos anuestra carpeta img.
        if($tmpimagen!=""){
            move_uploaded_file($tmpimagen,"../img/".$nombrearchivo);
        };
        $consultaSQL->bindParam(':imagen',$nombrearchivo);
        #Ejecutamos la sentencia SQL
        $consultaSQL->execute();
        header("Location:productos.php");
        break;

    case "Modificar":
        $consultaSQL= $conexion->prepare("UPDATE lanzamientos SET nombre=:nombre,descripcion=:descripcion,precio=:precio WHERE id=:id");
        $consultaSQL->bindParam(':nombre',$nombre);
        $consultaSQL->bindParam(':descripcion',$descripcion);
        $consultaSQL->bindParam(':precio',$precio);
        $consultaSQL->bindParam(':id',$id);
        $consultaSQL->execute();

        if( $imagen != "") {

            #modificar la imagen fisicamente
            #recuperamos el nombre de la imagen
            $fecha= new DateTime();
            $nombrearchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
            $tmpimagen=$_FILES["imagen"]["tmp_name"];
            #movemos nuestro archivo temporal
            move_uploaded_file($tmpimagen,"../img/".$nombrearchivo);
            #buscamos la imagen antigua
            $consultaSQL= $conexion->prepare("SELECT imagen FROM lanzamientos WHERE id=:id");
            $consultaSQL->bindParam(':id',$id);
            $consultaSQL->execute();
            $disco=$consultaSQL->fetch(PDO::FETCH_LAZY);
            #borramos la imagen
            if(isset($disco["imagen"]) && ($disco["imagen"] != "imagen.jpg")){
                if(file_exists("../img/".$disco["imagen"])) {
                    unlink("../img/".$disco["imagen"]);
                };
            };

            #Modificamos el registro
            $consultaSQL= $conexion->prepare("UPDATE lanzamientos SET nombre=:nombre,descripcion=:descripcion,precio=:precio,imagen=:imagen WHERE id=:id");
            $consultaSQL->bindParam(':nombre',$nombre);
            $consultaSQL->bindParam(':descripcion',$descripcion);
            $consultaSQL->bindParam(':precio',$precio);
            $consultaSQL->bindParam(':imagen',$nombrearchivo);
            $consultaSQL->bindParam(':id',$id);
            $consultaSQL->execute();
        };
        header("Location:productos.php");
        break;

    case "Cancelar":
        header("Location:productos.php");
        break;

    case "Seleccionar":

        $consultaSQL= $conexion->prepare("SELECT * FROM lanzamientos WHERE id=:id");
        $consultaSQL->bindParam(':id',$id);
        $consultaSQL->execute();
        #Cargamos datos uno a uno 
        $disco=$consultaSQL->fetch(PDO::FETCH_LAZY);
        $nombre=$disco['nombre'];
        $descripcion=$disco['descripcion'];
        $precio=$disco['precio'];
        $imagen=$disco['imagen'];
        break;

    case "Borrar":
        #Borramos la imagen de donde la hemos subido
        $consultaSQL= $conexion->prepare("SELECT imagen FROM lanzamientos WHERE id=:id");
        $consultaSQL->bindParam(':id',$id);
        $consultaSQL->execute();
        $disco=$consultaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($disco["imagen"]) && ($disco["imagen"] != "imagen.jpg")){
            if(file_exists("../img/".$disco["imagen"])) {
                unlink("../img/".$disco["imagen"]);
            }
        }
        #Borramos el registro
        $consultaSQL= $conexion->prepare("DELETE FROM lanzamientos WHERE id=:id");
        $consultaSQL->bindParam(':id',$id);
        $consultaSQL->execute();
        header("Location:productos.php");
        break;
};

#Preparamos la sentencia para mostrar todos los discos
$consultaSQL= $conexion->prepare("SELECT * FROM lanzamientos");
#Ejecutamos la sentencia
$consultaSQL->execute();
#Usamos fetchAll para que nos devuelva un array con todas las filas de los resultados y fetch_assoc, nos asocia los datos de la tabla.
$listadiscos=$consultaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-header">
                        Datos de los lanzamientos
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class = "form-group">
                                <label for="id">ID:</label>
                                <input type="text" required readonly class="form-control" value="<?php echo $id; ?>" name="id" id="id" placeholder="ID">
                            </div>

                            <div class = "form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" required class="form-control" value="<?php echo $nombre; ?>"  name="nombre" id="nombre" placeholder="Nombre del Lanzamiento">
                            </div>

                            <div class = "form-group">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" required class="form-control" value="<?php echo $descripcion; ?>"  name="descripcion" id="descripcion" placeholder="Escribe una descripcion">
                            </div>

                            <div class = "form-group">
                                <label for="precio">Precio:</label>
                                <input type="number" required class="form-control" value="<?php echo $precio; ?>"  name="precio" id="precio" min="0" max="100" step="0.01" placeholder="Introduce un precio">
                            </div>

                            <div class = "form-group">
                                <label for="imagen">Imagen:</label>
                                <br/>
                                <?php
                                    if($imagen!=""){ ?>
                                        <img class="img-thumbnail rounded mt-2" src="../img/<?php echo $imagen; ?>" width="50" alt="">
                                    <?php }; ?>

                                <input type="file" class="form-control mt-2" name="imagen" id="imagen" placeholder="Imagen">
                                <div class="btn-group mt-2" role="group">
                                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"" ?> value="Agregar" class="btn btn-success">Agregar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":"" ?> value="Modificar" class="btn btn-warning">Modificar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":"" ?> value="Cancelar"class="btn btn-info">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-5">
                <table class="table table-hover table-bordered">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($listadiscos as $disco) { ?>
                        <tr>
                            <td><?php echo $disco['id']; ?></td>
                            <td><?php echo $disco['nombre']; ?></td>
                            <td><?php echo $disco['descripcion']; ?></td>
                            <td><?php echo $disco['precio']; ?></td>
                            <td>
                                <img class="img-thumbnail rounded" src="../img/<?php echo $disco['imagen']; ?>" width="50" alt="">
                            </td>
                            <td>
                                
                                <form method="POST">
                                    <input type="hidden" name="id" id="id" value="<?php echo $disco['id']; ?>"/>
                                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                                </form>


                            </td>
                        </tr>
                    <?php }; ?>
                    </tbody>
                </table>
            </div>
<?php include("template/adminfooter.php"); ?>