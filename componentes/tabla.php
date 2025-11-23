<?php 
	session_start();
	require_once "../php/conexion.php";
	$conexion=conexion();
	$busqueda_id = isset($_GET['busqueda_id']) ? intval($_GET['busqueda_id']) : 0;
	// Se asegura de limpiar cualquier residuo del buscador
	unset($_SESSION['consulta']); 

?>

<button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#modalNuevo">
	<i class="bi bi-plus-lg"></i>Agregar nuevo Tallerista 
</button>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
                <th>ID</th> 
				<th>Nombre</th>
				<th>Apellido</th>
				<th>Teléfono</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$sql="SELECT id_tallerista,nombre,apellido,telefono 
					from talleristas";

					if ($busqueda_id > 0) {
						$sql .= " WHERE id_tallerista = " . $busqueda_id;
					}

				$result=mysqli_query($conexion,$sql);
				if ($result === false) {
					echo "Error en la consulta: " . mysqli_error($conexion); 
				}
				while($ver=mysqli_fetch_row($result)){ 

					// Los datos se pasan: id(0), nombre(1), apellido(2), teléfono(3)
					$datos=$ver[0]."||".
						   $ver[1]."||".
						   $ver[2]."||".
						   $ver[3]; 
			 ?>

			<tr>
                <td><?php echo $ver[0] ?></td> 
				<td><?php echo $ver[1] ?></td>
				<td><?php echo $ver[2] ?></td>
				<td><?php echo $ver[3] ?></td> 
				<td>
					<button class="btn btn-icon btn-edit" 
                            data-bs-toggle="modal" data-bs-target="#modalEdicion" 
                            onclick="agregaform('<?php echo $datos ?>')">
                        <i class="bi bi-pencil-fill"></i>
                    </button>

					<button class="btn btn-icon btn-delete" onclick="preguntarSiNo('<?php echo $ver[0] ?>')">
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