<?php 
	session_start();
	require_once "../php/conexion.php";
	$conexion=conexion();

	unset($_SESSION['consulta']); 
	$filtro_id = isset($_GET['busqueda_id']) ? intval($_GET['busqueda_id']) : 0;
	
?>

<button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#modalNuevo">
    <i class="bi bi-plus-lg"></i> Registrar Alumno 
</button>

<div class="table-responsive">
	<table class="table table-hover ">
		<thead>
			<tr>
				<th>ID Registro</th>
				<th>Matrícula</th> 
				<th>ID Actividad</th>
				<th>ID Tallerista</th>
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
				$sql="SELECT id_registro, 
							 matricula, 
							 id_actividad, 
							 id_tallerista,
							 nombre_act, 
							 nombrea, 
							 apellidoa, 
							 carrera,
							 semestre
					  FROM regalumnos";

				if ($filtro_id > 0) {
   				
    				$sql .= " WHERE matricula = " . $filtro_id;
				}

				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)){ 

					$datos=$ver[0]."||". // id_registro
						   $ver[1]."||". // matricula
						   $ver[2]."||". // id_actividad
						   $ver[3]."||". // id_tallerista
						   $ver[4]."||". // nombre_act
						   $ver[5]."||". // nombrea
						   $ver[6]."||". // apellidoa
						   $ver[7]."||". // carrera
						   $ver[8]; 	 // semestre
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
				<td><?php echo $ver[8] ?></td>
				<td>
					<button class="btn btn-icon btn-edit" 
                            data-bs-toggle="modal" data-bs-target="#modalEdicion" 
                            onclick="agregaform('<?php echo $datos ?>')">
                        <i class="bi bi-pencil-fill"></i>
                    </button>

                    <button class="btn btn-icon btn-delete" 
                            onclick="preguntarSiNo('<?php echo $ver[0] ?>')">
                        <i class="bi bi-trash-fill"></i>
                    </button>
				</td>
				
			</tr>
			<?php 
		}
			?>
		</tbody>
	</table>
</div>
