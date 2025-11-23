<?php 
	require_once "conexion.php";
	$conexion=conexion();
	
	$id=$_POST['id']; 

	$sql="DELETE FROM asignarpts WHERE id_asignacion='$id'";
	$result=mysqli_query($conexion,$sql);
	
	if ($result) {
		echo 1; 
	} else {
		echo mysqli_error($conexion); 
	}
// Sin etiqueta de cierre ?>