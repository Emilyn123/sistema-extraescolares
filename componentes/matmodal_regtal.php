<?php 
    // AJUSTA ESTA RUTA si tu archivo de conexión no está en el directorio superior.
    require_once "conexion.php"; 
    $conexion=conexion();

    // Consulta para obtener las MATRÍCULAS únicas
    $sql_matriculas = "SELECT DISTINCT matricula FROM regalumnos ORDER BY matricula"; 
    $result_matriculas = mysqli_query($conexion, $sql_matriculas);
    
    // Devolvemos la opción por defecto primero
    echo "<option value=''>Seleccione una Matrícula</option>";

    if ($result_matriculas && mysqli_num_rows($result_matriculas) > 0) {
        while($alumno = mysqli_fetch_assoc($result_matriculas)){ 
            $matricula = $alumno['matricula'];
            // Devolvemos las opciones en formato HTML
            echo "<option value='{$matricula}'>{$matricula}</option>";
        }
    } else {
        // En caso de error o no resultados
        echo "<option value=''>No hay matrículas disponibles</option>";
    }
?>