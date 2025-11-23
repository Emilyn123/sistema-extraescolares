<?php 
	session_start();
	require_once "../php/conexion.php"; // Ruta a la conexión
	$conexion=conexion();

	// CAMBIO: Se obtiene el ID de perfil (matrícula del alumno)
	if (!isset($_SESSION['id_perfil'])) {
		die("Error: No ha iniciado sesión o su sesión ha expirado.");
	}
	$matricula_alumno = $_SESSION['id_perfil'];

	unset($_SESSION['consulta']); 

	// --- CAMBIO: Lógica para la suma de puntos ---
	$sql_puntos = "SELECT SUM(puntos) AS total_puntos 
				   FROM asignarpts 
				   WHERE matricula = '$matricula_alumno'";
	
	$result_puntos = mysqli_query($conexion, $sql_puntos);
	$fila_puntos = mysqli_fetch_assoc($result_puntos);
	
	// Si no tiene puntos, $fila_puntos['total_puntos'] será NULL, así que lo convertimos a 0
	$puntos_acumulados = $fila_puntos['total_puntos'] ? $fila_puntos['total_puntos'] : 0;
	// --- Fin de la lógica de puntos ---
?>

<div class="table-responsive">
	
	<div class="alert alert-info" role="alert">
		<h4>Total Acumulado: 
			<strong><?php echo $puntos_acumulados; ?> / 200 Puntos</strong>
		</h4>
	</div>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID Asignación</th> 
					<th>ID Tallerista</th>
					<th>Actividad</th>
					<th>Estado</th>
					<th>Puntos</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					// CAMBIO: Consulta filtrada por la matrícula del alumno
					// y seleccionando solo los campos solicitados
					$sql="SELECT id_asignacion, 
								id_tallerista,
								nombre_act, 
								estado, 
								puntos
						FROM asignarpts
						WHERE matricula = '$matricula_alumno'"; // <-- FILTRO POR SESIÓN

					$result=mysqli_query($conexion,$sql);
					while($ver=mysqli_fetch_row($result)){ 

						// CAMBIO: La cadena $datos ya no es necesaria
				?>

			<tr>
				<td><?php echo $ver[0] ?></td> 
				<td><?php echo $ver[1] ?></td>
				<td><?php echo $ver[2] ?></td>
				<td><?php echo $ver[3] ?></td>
				<td><?php echo $ver[4] ?></td>
				
				</tr>
			<?php 
		}
			 ?>
			</tbody>
		</table>
</div>