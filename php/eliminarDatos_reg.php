<?php 
	require_once "conexion.php";
	$conexion=conexion();
	
	$id_registro=$_POST['id_registro']; 

	$sql="DELETE FROM regalumnos WHERE id_registro='$id_registro'";
	$result=mysqli_query($conexion,$sql);
	
	if ($result) {
		echo 1; 
	} else {
		echo mysqli_error($conexion); 
	}
?>