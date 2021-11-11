<?php
$host="localhost";
$bd="discos";
$usuario="root";
$password="";

#Establecemos la conexion
try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$password);
    #if($conexion){ echo "La conexion se ha realizado correctamente";}
} catch ( Exception $ex) {
    #Si la conexión falla, y por tanto, existe un error, le decimos que nos lo indique
    echo $ex->getMessage();
};
?>