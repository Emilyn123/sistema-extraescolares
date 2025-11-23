<?php 
	session_start();
	require_once "conexion.php";
	$conexion=conexion();

	if (!isset($_SESSION['id_perfil'])) {
		echo "Error: Sesión no válida";
		exit();
	}
	$id_perfil_tallerista = $_SESSION['id_perfil'];
	
	// CAMBIO: Recibe 'idoriginal' y el nuevo 'id_asignacion'
	$idOriginal=$_POST['idoriginal'];
	$id_asig=$_POST['id_asignacion'];

	

	$mat=$_POST['matricula']; 
	$nom_act=$_POST['nombre_act'];
	$estado=$_POST['estado'];
	$puntos=$_POST['puntos'];
	
	// CAMBIO: 'id_asignacion' se actualiza en el SET
	// 'idoriginal' se usa en el WHERE
	$sql = "UPDATE asignarpts SET 
					id_asignacion='$id_asig',
					matricula='$mat', 
					nombre_act='$nom_act',
					estado='$estado',
					puntos='$puntos'
			WHERE id_asignacion='$idOriginal' 
			  AND id_tallerista = '$id_perfil_tallerista'";

	$result = mysqli_query($conexion, $sql);

	if ($result) {
		echo 1;
	} else {
		// Esto te avisará si intentas cambiar el ID a uno que ya existe
		echo mysqli_error($conexion);
	}
?>