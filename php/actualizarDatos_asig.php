<?php 
	require_once "conexion.php";
	$conexion=conexion();
	
	// ID original (PK)
	$idOriginal=$_POST['idoriginal'];
	
	// Recibe los 6 campos
	$id_asig_u=$_POST['id_asignacion'];
	$id_tal_u=$_POST['id_tallerista'];
	$mat=$_POST['matricula'];
	$nom_act=$_POST['nombre_act'];
	$estado=$_POST['estado'];
	$puntos=$_POST['puntos'];

	// UPDATE con 6 campos
	$sql = "UPDATE asignarpts SET 
					id_asignacion='$id_asig_u',
					id_tallerista='$id_tal_u',
					matricula='$mat',
					nombre_act='$nom_act',
					estado='$estado',
					puntos='$puntos'
			WHERE id_asignacion='$idOriginal'"; // Busca por el ID original

	$result = mysqli_query($conexion, $sql);

	if ($result) {
		echo 1;
	} else {
		echo mysqli_error($conexion);
	}
// Sin etiqueta de cierre ?>