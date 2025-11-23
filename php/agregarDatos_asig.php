<?php 
error_reporting(0);
ob_start();

session_start();
	require_once "conexion.php";
	$conexion=conexion();
	
	if (!isset($_SESSION['id_perfil'])) {
		ob_end_clean();
		echo "0. Error: Sesión no válida. No se pudo obtener el ID del tallerista.";
		exit();
	}
	$id_tallerista_sesion = $_SESSION['id_perfil'];

	// ELIMINADA: La recepción de $id_asig. La base de datos lo generará.
	$mat=$_POST['matricula']; 
	$nom_act=$_POST['nombre_act'];
	$estado=$_POST['estado'];
	$puntos=$_POST['puntos'];

	// MODIFICADA: La consulta INSERT omite la columna 'id_asignacion' y su valor
	$sql="INSERT into asignarpts (id_tallerista, 
								 matricula, 
								 nombre_act, 
								 estado,
								 puntos)
						VALUES ('$id_tallerista_sesion', 
								'$mat', 
								'$nom_act', 
								'$estado', 
								'$puntos')";
	
	$result=mysqli_query($conexion,$sql);
	ob_end_clean();

	if ($result) {
        // DEVUELVE LA ID GENERADA por AUTO_INCREMENT
		echo mysqli_insert_id($conexion); 
	} else {
        // Devuelve 0 para indicar un error al JavaScript
		echo "0. Error SQL: " . mysqli_error($conexion); 
	}
?>