<?php 
session_start();
#La variable todavía no esta creada pero la necesitamos para saber si hay un usuario logeado
    if(!isset($_SESSION['usuario'])) {
        header("Location:login.php");
    }else{
        if($_SESSION['usuario']=="ok"){
            $nombreusuario=$_SESSION['nombreusuario'];
        };
    };
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css" />
    <title>Admin | Jhon Kleiber</title>
</head>
<body class="bg-light">
    <?php $url="http://".$_SERVER['HTTP_HOST']."/tienda-online" ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top">
        <div class="container-lg">
            <a class="navbar-brand" href="#">JK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="">Admin<span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url;?>/admin/inicio.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url;?>/admin/productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url;?>/admin/pedidos.php">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url;?>/admin/cerrarsesion.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-5 mb-5 pt-5 pb-5">