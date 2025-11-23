<?php

require_once "conexion.php";
$conexion = conexion();

$sql = "SELECT id_tallerista FROM talleristas ORDER BY id_tallerista ASC";
$result = mysqli_query($conexion, $sql);

$ids = array();

while ($fila = mysqli_fetch_row($result)) {
 
    $ids[] = (string)$fila[0]; 
}

header('Content-Type: application/json');
echo json_encode($ids);

?>