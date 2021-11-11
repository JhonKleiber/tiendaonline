<?php
session_start();
#Recogemos los datos del REQUEST
$id = $_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$precio = $_REQUEST["precio"];
$imagen = $_REQUEST["imagen"];

#Guardamos los datos en la sesion
$prodsession = [$id, $nombre, $precio, $imagen];
$_SESSION["$nombre"] = $prodsession;

#Volvemos a productos.php
header("Location:productos.php");
?>