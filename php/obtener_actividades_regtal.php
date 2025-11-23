<?php
require_once "conexion.php"; // Asegúrate de que la ruta sea correcta
$conexion = conexion();

// Consulta para obtener el ID y nombre de las actividades
$sql = "SELECT id_actividad, nombre_act FROM actividades ORDER BY nombre_act ASC";
$result = mysqli_query($conexion, $sql);

$options = '';
if ($result && mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $nombre_completo = htmlspecialchars($row['id_actividad'] . ' - ' . $row['nombre_act']);
        $options .= "<option value=\"{$row['id_actividad']}\">{$nombre_completo}</option>";
    }
}
echo $options;
?>