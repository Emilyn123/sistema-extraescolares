<?php 
	require_once "conexion.php";
	$conexion=conexion();
    
    // 1. Recibimos el ID con el que se va a buscar (el original)
	$idOriginal=$_POST['idoriginal'];
    // 2. Recibimos el NUEVO ID que se va a asignar
    $idNuevo=$_POST['idtallu'];
    
	$n=$_POST['nombre'];
	$a=$_POST['apellido'];
	$t=$_POST['telefono'];

    // Si el ID original y el nuevo ID son iguales, simplemente actualizamos la fila existente.
    if ($idOriginal == $idNuevo) {
        $sql = "UPDATE talleristas SET 
                    nombre='$n',
                    apellido='$a',
                    telefono='$t'
                WHERE id_tallerista='$idOriginal'";
    } else {
        // Si el ID ha cambiado, actualizamos la clave primaria y todos los demás campos.
        // NOTA: Esta operación es delicada. Si el $idNuevo ya existe, MySQL fallará.
        $sql = "UPDATE talleristas SET 
                    id_tallerista='$idNuevo', 
                    nombre='$n',
                    apellido='$a',
                    telefono='$t'
                WHERE id_tallerista='$idOriginal'";
    }

    $result = mysqli_query($conexion, $sql);

	if ($result) {
        echo 1;
    } else {
        // Devolvemos el error de MySQL para diagnóstico
        echo mysqli_error($conexion);
    }
?>