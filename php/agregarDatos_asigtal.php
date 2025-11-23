<?php 
	session_start();
	require_once "conexion.php";
	$conexion=conexion();

	if (!isset($_SESSION['id_perfil'])) {
		echo "Error: Sesión no válida";
		exit();
	}
	$id_tallerista_sesion = $_SESSION['id_perfil'];

	
	// CAMBIO: Se recibe 'id_asignacion' del formulario
	
	$mat=$_POST['matricula']; 
	$nom_act=$_POST['nombre_act'];
	$estado=$_POST['estado'];
	$puntos=$_POST['puntos'];

	// CAMBIO: 'id_asignacion' añadido al INSERT
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

	if ($result) {
		echo 1; 
	} else {
		// Esto te avisará si intentas usar un ID que ya existe
		echo mysqli_error($conexion); 
	}
?>