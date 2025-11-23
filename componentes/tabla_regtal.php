<?php 
	session_start();
	require_once "../php/conexion.php";
	$conexion=conexion();
	
	
	if (isset($_SESSION['id_perfil'])) {
		$id_perfil = $_SESSION['id_perfil'];
	} else {
		
		echo "Error: Sesión no iniciada. Por favor, inicie sesión.";
		exit; 
	}
?>

<button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#modalNuevo">
	<i class="bi bi-plus-lg"></i>Registrar Alumno 
</button>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>ID Registro</th>
				<th>Matrícula</th> 
				<th>ID Actividad</th>
				<th>Actividad</th>
				<th>Nombre Alumno</th>
				<th>Apellido Alumno</th>
				<th>Carrera</th>
				<th>Semestre</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				
			
				$sql="SELECT id_registro, matricula, id_actividad, 
							 nombre_act, nombrea, apellidoa, carrera, semestre
					  FROM regalumnos
					  WHERE id_tallerista = ?"; 
				
				
				$stmt = mysqli_prepare($conexion, $sql);
				
				
				mysqli_stmt_bind_param($stmt, "s", $id_perfil);
				
				mysqli_stmt_execute($stmt);
				
				
				$result = mysqli_stmt_get_result($stmt);

				while($ver=mysqli_fetch_row($result)){ 
					
					
					$datos=$ver[0]."||". // id_registro
						   $ver[1]."||". // matricula
						   $ver[2]."||". // id_actividad
						   $ver[3]."||". // nombre_act
						   $ver[4]."||". // nombrea
						   $ver[5]."||". // apellidoa
						   $ver[6]."||". // carrera
						   $ver[7]; 	 // semestre
			 ?>
			<tr>
				<td><?php echo $ver[0] ?></td> 
				<td><?php echo $ver[1] ?></td> 
				<td><?php echo $ver[2] ?></td>
				<td><?php echo $ver[3] ?></td>
				<td><?php echo $ver[4] ?></td>
				<td><?php echo $ver[5] ?></td>
				<td><?php echo $ver[6] ?></td>
				<td><?php echo $ver[7] ?></td>
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