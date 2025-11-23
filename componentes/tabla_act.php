<?php 
	session_start();
	require_once "conexion.php"; 
	$conexion=conexion();
	
	$filtro_id = isset($_GET['busqueda_id']) ? intval($_GET['busqueda_id']) : 0;
?>

<button class="btn btn-add-new" data-bs-toggle="modal" data-bs-target="#modalNuevo">
    <i class="bi bi-plus-lg"></i> Agregar nueva Actividad 
</button>

<div class="table-responsive">

    <table class="table table-hover ">
        <thead>
            <tr>
                <th>ID Actividad</th> 
                <th>ID Tallerista</th>
                <th>Actividad</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Puntuación</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql="SELECT id_actividad, 
                            id_tallerista, 
                            nombre_act, 
                            fecha_inicio, 
                            fecha_final, 
                            puntuacion 
                    FROM actividades";

                
                if ($filtro_id > 0) {
                
                    $sql .= " WHERE id_actividad = " . $filtro_id;
                }

                $result=mysqli_query($conexion,$sql);
            
                while($ver=mysqli_fetch_row($result)){ 

                    $datos=$ver[0]."||". // id_actividad
                        $ver[1]."||". // id_tallerista
                        $ver[2]."||". // nombre_act
                        $ver[3]."||". // fecha_inicio
                        $ver[4]."||". // fecha_final
                        $ver[5]; 	 // puntuacion
            ?>

            <tr>
                <td><?php echo $ver[0] ?></td> 
                <td><?php echo $ver[1] ?></td>
                <td><?php echo $ver[2] ?></td>
                <td><?php echo $ver[3] ?></td>
                <td><?php echo $ver[4] ?></td>
                <td><?php echo $ver[5] ?></td>
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