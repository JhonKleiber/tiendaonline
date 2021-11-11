<?php include("template/header.php"); ?>
<div class="p-5 mt-5 mb-5 text-center">
    <div class="container">
        <h1 class="display-3">API</h1>
        <hr class="my-2">
        <p class="lead">Para obtener la información de todos los lanzamientos, puede pulsar el siguiente botón: </p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="api.php" role="button">API</a>
        </p>
        <p class="lead">Si desea obtener la información de un solo lanzamiento, deberá añadir a la URL anterior "?id=id_del_producto_a_consultar".<br/>
        Por ejemplo, para acceder a la informacón del lanzamiento "I want u babe" cuyo id=11, deberá añadir lo siguiente: "?id=11".<br/>
        Si pulsa en el siguiente boton, podrá dirigirse al ejemplo:</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="api.php?id=11" role="button">API_Individual</a>
        </p>
    </div>
</div>
<?php include("template/footer.php"); ?>
