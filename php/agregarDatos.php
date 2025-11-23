<?php 
	require_once "conexion.php";
	$conexion=conexion();

	$n=$_POST['nombre'];
	$a=$_POST['apellido'];
	$t=$_POST['telefono'];

	$sql="INSERT into talleristas (nombre, apellido, telefono)
								values ('$n', '$a', '$t')";
  
    
    $result=mysqli_query($conexion,$sql);

 if ($result) {
        // DEVUELVE LA ID GENERADA
        echo mysqli_insert_id($conexion); 
    } else {
        // Devuelve 0 para indicar un error al JavaScript
        echo "0. Error SQL: " . mysqli_error($conexion);
        // Si necesitas depurar el error SQL en consola, cambia 'echo 0' por 'echo "Error: " . mysqli_error($conexion);'
    }
   
?>