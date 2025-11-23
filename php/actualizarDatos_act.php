<?php 
	require_once "conexion.php";
	$conexion=conexion();
	
	// ID original (PK)
	$idOriginal=$_POST['idoriginal'];
	
	// Nuevos datos (pueden ser iguales o diferentes)
	$idNuevo=$_POST['id_actividad']; // La clave primaria NUEVA
	$id_tall=$_POST['id_tallerista'];
	$nombre=$_POST['nombre_act'];
	$f_ini=$_POST['fecha_inicio'];
	$f_fin=$_POST['fecha_final'];
	$puntos=$_POST['puntuacion'];

	// Si el ID no cambió, solo actualiza el resto
	if ($idOriginal == $idNuevo) {
		$sql = "UPDATE actividades SET 
						id_tallerista='$id_tall',
						nombre_act='$nombre',
						fecha_inicio='$f_ini',
						fecha_final='$f_fin',
						puntuacion='$puntos'
				WHERE id_actividad='$idOriginal'";
	} else {
		// Si el ID cambió, actualiza todo (incluyendo la PK)
		$sql = "UPDATE actividades SET 
						id_actividad='$idNuevo', 
						id_tallerista='$id_tall',
						nombre_act='$nombre',
						fecha_inicio='$f_ini',
						fecha_final='$f_fin',
						puntuacion='$puntos'
				WHERE id_actividad='$idOriginal'";
	}

	$result = mysqli_query($conexion, $sql);

	if ($result) {
		echo 1;
	} else {
		echo mysqli_error($conexion);
	}
?>