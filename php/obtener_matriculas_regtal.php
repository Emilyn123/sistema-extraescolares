<?php
require_once "conexion.php"; // Asegúrate de que la ruta sea correcta
$conexion = conexion();

// Consulta para obtener la matrícula, nombre y apellido de los alumnos
$sql = "SELECT matricula, nombrea, apellidoa FROM alumnos ORDER BY matricula ASC";
$result = mysqli_query($conexion, $sql);

$options = '';
if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $nombre_completo = htmlspecialchars($row['matricula'] . ' - ' . $row['nombrea'] . ' ' . $row['apellidoa']);
        $options .= "<option value=\"{$row['matricula']}\">{$nombre_completo}</option>";
    }
}
echo $options;
?>