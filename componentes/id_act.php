<?php 
    // Incluye el archivo de conexión. Ajusta la ruta si es necesario.
    require_once "conexion.php"; 
    $conexion=conexion();

    // Obtener el ID seleccionado actualmente (para que la opción quede marcada)
    $selected_id = isset($_GET['busqueda_id']) ? intval($_GET['busqueda_id']) : 0;

    // Consulta para obtener todos los IDs y nombres de las actividades
    $sql_actividades = "SELECT id_actividad, nombre_act FROM actividades ORDER BY id_actividad";
    $result_actividades = mysqli_query($conexion, $sql_actividades);
?>

<div class="search-container">
    <form action="index_act.php" method="GET" class="search-form" role="search">
        <label for="select_actividad_id">Buscar Actividad por ID</label>
        <div class="input-group">
            
            <select 
                name="busqueda_id" 
                id="select_actividad_id" 
                class="form-select" 
                onchange="this.form.submit()" 
                style="border-top-right-radius: 0; border-bottom-right-radius: 0;"> 
                
                <option value="0" <?php if ($selected_id == 0) echo 'selected'; ?>>
                    Mostrar Todas las Actividades
                </option>

                <?php 
                    // Generar las opciones dinámicamente
                    if ($result_actividades && mysqli_num_rows($result_actividades) > 0) {
                        while($actividad = mysqli_fetch_assoc($result_actividades)){ 
                            $id = $actividad['id_actividad'];
                            $nombre = $actividad['nombre_act'];
                            $selected = ($id == $selected_id) ? 'selected' : '';
                            
                            // Texto visible: ID - Nombre | Valor enviado: solo el ID
                            echo "<option value='{$id}' {$selected}>{$id} - {$nombre}</option>";
                        }
                    }
                ?>
            </select>
         
            <?php if ($selected_id > 0): ?>
                <a href="index_act.php" class="btn btn-outline-secondary">Limpiar</a>
            <?php endif; ?>
        </div>
    </form>
</div>