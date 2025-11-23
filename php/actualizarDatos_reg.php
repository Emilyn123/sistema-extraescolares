<?php 
	session_start(); 
	require_once "conexion.php";
	$conexion=conexion();
	
	if (isset($_SESSION['id_perfil'])) {
		$id_tallerista = $_SESSION['id_perfil'];
	} else {
		// En lugar de un mensaje, devolvemos 0 para que JavaScript sepa que hubo un error.
		echo 0; 
		exit; 
	}
	
	// ELIMINADO: Ya no se recibe $id_reg = $_POST['id_registro'];
	$mat=$_POST['matricula']; 
	$id_act=$_POST['id_actividad'];
	$nom_act=$_POST['nombre_act'];
	$nom_a=$_POST['nombrea'];
	$ape_a=$_POST['apellidoa'];
	$carrera=$_POST['carrera'];
	$sem=$_POST['semestre'];

	
	// MODIFICADA: La consulta INSERT omite la columna 'id_registro'
	$sql="INSERT into regalumnos (matricula, id_actividad, 
								 id_tallerista, 
								 nombre_act, nombrea, apellidoa, carrera, semestre)
						VALUES ('$mat', '$id_act', 
								'$id_tallerista', 
								'$nom_act', '$nom_a', '$ape_a', '$carrera', '$sem')";
	
	$result=mysqli_query($conexion,$sql);

	if ($result) {
        // DEVUELVE LA ID GENERADA por AUTO_INCREMENT
		echo mysqli_insert_id($conexion); 
	} else {
        // Devuelve 0 para indicar un error al JavaScript
		echo 0; 
	}