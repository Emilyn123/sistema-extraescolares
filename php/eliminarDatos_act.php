<?php 
	require_once "conexion.php";
	$conexion=conexion();
	
	// Recibe el 'id' enviado por la función eliminarDatos()
	$id=$_POST['id']; // Corresponde a id_actividad

	// Consulta DELETE para la tabla 'actividades'
	$sql="DELETE FROM actividades WHERE id_actividad='$id'";
	$result=mysqli_query($conexion,$sql);
	
	if ($result) {
		echo 1; 
	} else {
		echo mysqli_error($conexion); 
	}
?>