<?php 
	session_start();
	require_once "../php/conexion.php";
	$conexion=conexion();

	if (!isset($_SESSION['id_perfil'])) {
		die("Error: No ha iniciado sesión o su sesión ha expirado.");
	}
	$id_perfil_tallerista = $_SESSION['id_perfil'];

	unset($_SESSION['consulta']); 
?>

<button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#modalNuevo">
	<i class="bi bi-plus-lg"></i>Asignar Puntos 
</button>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID Asignación</th>
				<th>Matrícula</th> 
				<th>Actividad</th>
				<th>Estado</th>
				<th>Puntos</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				
				$sql="SELECT id_asignacion, 
							 matricula, 
							 nombre_act, 
							 estado, 
							 puntos
					  FROM asignarpts 
					  WHERE id_tallerista = '$id_perfil_tallerista'";

				$result=mysqli_query($conexion,$sql);

				if (!$result) {
					die("<b>Error en la consulta SQL:</b> " . mysqli_error($conexion) . 
					   "<br><b>Consulta ejecutada:</b> " . $sql);
				}

				while($ver=mysqli_fetch_row($result)){ 

					// El string de datos ya incluye id_asignacion (ver[0])
					$datos=$ver[0]."||". // id_asignacion (PK)
						   $ver[1]."||". // matricula
						   $ver[2]."||". // nombre_act
						   $ver[3]."||". // estado
						   $ver[4]; 	     // puntos
			 ?>

			<tr>
				<td><?php echo $ver[0] ?></td>
				<td><?php echo $ver[1] ?></td> 
				<td><?php echo $ver[2] ?></td>
				<td><?php echo $ver[3] ?></td>
				<td><?php echo $ver[4] ?></td>
				<td>
					<button class="btn btn-icon btn-edit" 
                            data-bs-toggle="modal" data-bs-target="#modalEdicion" 
                            onclick="agregaform('<?php echo $datos ?>')">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
				</td>
			</tr>
			<?php 
		}
			 ?>
		</tbody>
	</table>
</div>