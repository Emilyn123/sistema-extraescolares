<?php 
	require_once "conexion.php"; 
	$conexion=conexion();
	
	// 1. CONSULTAR EL ÚLTIMO ID
	$sql_max_id = "SELECT MAX(id_actividad) as max_id FROM actividades";
	$resultado_max_id = mysqli_query($conexion, $sql_max_id);
	$fila = mysqli_fetch_array($resultado_max_id);
	
	$ultimo_id = $fila['max_id'];

    // CORRECCIÓN: Si el último ID es NULL (tabla vacía) o 0, el nuevo ID debe ser 1.
    if ($ultimo_id === NULL || $ultimo_id == 0) {
        $id_act = 1;
    } else {
        $id_act = $ultimo_id + 1;
    }

	// 2. Recibe el resto de campos
	$id_tall=$_POST['id_tallerista'];
	$nombre=$_POST['nombre_act'];
	$f_ini=$_POST['fecha_inicio'];
	$f_fin=$_POST['fecha_final'];
	$puntos=$_POST['puntuacion'];

	// 3. Consulta INSERT usando el ID calculado
	$sql="INSERT into actividades (id_actividad, 
								 id_tallerista, 
								 nombre_act, 
								 fecha_inicio, 
								 fecha_final, 
								 puntuacion)
						VALUES ('$id_act', 
								'$id_tall', 
								'$nombre', 
								'$f_ini', 
								'$f_fin', 
								'$puntos')";
	
	$result=mysqli_query($conexion,$sql);

	if ($result) {
		echo 1; 
	} else {
		echo mysqli_error($conexion); 
	}
?>