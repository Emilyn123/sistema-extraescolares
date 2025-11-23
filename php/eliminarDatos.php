<?php 
	require_once "conexion.php";
	$conexion=conexion();
	$id=$_POST['id']; // Corresponde a id_tallerista

	// Eliminación de la tabla 'talleristas' por 'id_tallerista'
	$sql="DELETE from talleristas where id_tallerista='$id'";
    $result=mysqli_query($conexion,$sql);
    
    if ($result) {
        echo 1; 
    } else {
        // Muestra el error si la eliminación falla por alguna razón
        echo mysqli_error($conexion); 
    }
?>