<?php
require_once "conexion.php";
$conexion = conexion();

$sql = "SELECT DISTINCT matricula FROM regalumnos ORDER BY matricula ASC";
$result = mysqli_query($conexion, $sql);

$matriculas = array();

while ($fila = mysqli_fetch_row($result)) {

    $matriculas[] = (string)$fila[0]; 
}

header('Content-Type: application/json');
echo json_encode($matriculas);

?>

