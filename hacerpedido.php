<?php
session_start();
include("admin/config/conexion.php");
#Sacamos el pedido máximo
$consultaSQL= $conexion->prepare("SELECT MAX(n_pedido) as max_id FROM pedidos;");
#Ejecutamos la sentencia SQL
$consultaSQL->execute();
#Asociamos
$max_id = $consultaSQL->fetch(PDO::FETCH_ASSOC);
$n_pedido = $max_id['max_id']+1;

#Recogemos los datos de la sesión
foreach($_SESSION as $pedido) {
$producto_id=$pedido[0];
$nombre_producto=$pedido[1];
$precio_producto=(float)$pedido[2];
#Insertamos los datos en la tabla pedidos
$consultaSQL= $conexion->prepare("INSERT INTO pedidos (producto_id,nombre_producto,precio_producto,n_pedido) VALUES (:producto_id,:nombre_producto,:precio_producto,:n_pedido);");
$consultaSQL->bindParam(':producto_id',$producto_id);
$consultaSQL->bindParam(':nombre_producto',$nombre_producto);
$consultaSQL->bindParam(':precio_producto',$precio_producto);
$consultaSQL->bindParam(':n_pedido',$n_pedido);
$consultaSQL->execute();
};
$conexion = null; 

#Confirmamos al usuario que hemos recibido su pedido
session_destroy();
header("Location:pedidook.php");
?>