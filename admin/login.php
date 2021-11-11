<?php
session_start();
if($_POST) {
    if(($_POST['usuario']=="Jhon") && ($_POST['contrasenia']=="123")) {
        $_SESSION['usuario']="ok";
        $_SESSION['nombreusuario']="Jhon";
        header("location:inicio.php");
    }else{
        $mensaje="El usuario o contraseña son incorrectos";
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
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card mt-5">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <?php if(isset($mensaje)) {?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php }; ?>
                        <form method="POST">
                            <div class = "form-group">
                                <label for="exampleInputEmail1">Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Introduce tu usuario">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Introduce tu contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Entrar</button>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
<script src="../libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>