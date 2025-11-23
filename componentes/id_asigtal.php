<?php 
    require_once "conexion.php"; 
    $conexion=conexion();

    $selected_id = isset($_GET['busqueda_id']) ? intval($_GET['busqueda_id']) : 0;

    
    $sql_actividades = "SELECT id_asignacion, id_tallerista FROM asignarpts ORDER BY id_asignacion";
    $result_actividades = mysqli_query($conexion, $sql_actividades);
?>

<div class="search-container">
    <form action="index_asigtal.php" method="GET" class="search-form" role="search">
        <label for="select_asignacion_id">Buscar Asignacion por ID</label>
        <div class="input-group">
            
            <select 
                name="busqueda_id" 
                id="select_actividad_id" 
                class="form-select" 
                onchange="this.form.submit()" 
                style="border-top-right-radius: 0; border-bottom-right-radius: 0;"> 
                
                <option value="0" <?php if ($selected_id == 0) echo 'selected'; ?>>
                    Mostrar Todas las Asignaciones
                </option>

                <?php 
                
                    if ($result_actividades && mysqli_num_rows($result_actividades) > 0) {
                        while($actividad = mysqli_fetch_assoc($result_actividades)){ 
                            $id = $actividad['id_asignacion'];
                            $nombre = $actividad['id_tallerista'];
                            $selected = ($id == $selected_id) ? 'selected' : '';
                            
                           
                            echo "<option value='{$id}' {$selected}>{$id} - {$nombre}</option>";
                        }
                    }
                ?>
            </select>
         
            <?php if ($selected_id > 0): ?>
                <a href="index_asigtal.php" class="btn btn-outline-secondary">Limpiar</a>
            <?php endif; ?>
        </div>
    </form>
</div>