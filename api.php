<?php include("admin/config/conexion.php"); ?>
<?php
$devolver = array();
if(isset($_REQUEST['id'])) {
    $consultaSQL = $conexion->prepare("SELECT id,nombre,descripcion,precio FROM lanzamientos WHERE id=:id");
    $consultaSQL->bindParam(':id',$_REQUEST['id']);
    $consultaSQL->execute();
    while ($listadiscos = $consultaSQL->fetchAll(PDO::FETCH_ASSOC)) {
        $devolver[]=$listadiscos;   
    };
}else {
    $consultaSQL = $conexion->prepare("SELECT id,nombre,descripcion,precio FROM lanzamientos");
    $consultaSQL->execute();
    while ($listadiscos = $consultaSQL->fetchAll(PDO::FETCH_ASSOC)) {
        $devolver[]=$listadiscos;   
    };
};
$conexion = null;

header('Content-Type: application/json');
echo json_encode($devolver);
?>