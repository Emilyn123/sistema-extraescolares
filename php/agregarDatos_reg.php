<?php 
	require_once "conexion.php";
	$conexion=conexion();
	
	

	$mat=$_POST['matricula']; 
	$id_act=$_POST['id_actividad'];
	$id_tallerista=$_POST['id_tallerista'];
	$nom_act=$_POST['nombre_act'];
	$nom_a=$_POST['nombrea'];
	$ape_a=$_POST['apellidoa'];
	$carrera=$_POST['carrera'];
	$sem=$_POST['semestre'];

	
	$sql="INSERT into regalumnos (
								 matricula, 
								 id_actividad, 
								 id_tallerista,
								 nombre_act, 
								 nombrea, 
								 apellidoa, 
								 carrera,
								 semestre)
						VALUES (
								'$mat', 
								'$id_act', 
								'$id_tallerista',
								'$nom_act', 
								'$nom_a', 
								'$ape_a', 
								'$carrera',
								'$sem')";
	
	$result=mysqli_query($conexion,$sql);

	if ($result) {
		echo mysqli_insert_id($conexion);
	} else {
		echo "0. Error SQL: " . mysqli_error($conexion);
	}
?>