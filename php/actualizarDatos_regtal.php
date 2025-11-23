<?php 
	session_start(); // CAMBIO: Iniciar sesión
	require_once "conexion.php";
	$conexion=conexion();

	// CAMBIO: Obtenemos el ID de la sesión para seguridad
	if (isset($_SESSION['id_perfil'])) {
		$id_perfil = $_SESSION['id_perfil'];
	} else {
		echo "Error: Sesión no válida";
		exit; 
	}
	
	$id_original=$_POST['id_original']; 
	
	// CAMBIO: Recibimos 8 campos (sin id_tallerista)
	$id_nuevo=$_POST['id_registro'];
	$mat_nueva=$_POST['matricula'];
	$id_act=$_POST['id_actividad'];
	$nom_act=$_POST['nombre_act'];
	$nom_a=$_POST['nombrea'];
	$ape_a=$_POST['apellidoa'];
	$carrera=$_POST['carrera'];
	$sem=$_POST['semestre'];
	
	
	$sql = "UPDATE regalumnos SET 
					id_registro='$id_nuevo', 
					matricula='$mat_nueva', 
					id_actividad='$id_act',
					nombre_act='$nom_act',
					nombrea='$nom_a',
					apellidoa='$ape_a',
					carrera='$carrera',
					semestre='$sem'
			WHERE id_registro='$id_original'
			  AND id_tallerista = '$id_perfil'";

	$result = mysqli_query($conexion, $sql);

	if ($result) {
		echo 1;
	} else {
		echo mysqli_error($conexion);
	}
?>