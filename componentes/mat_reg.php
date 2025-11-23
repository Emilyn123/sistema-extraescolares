<?php 
   
    require_once "conexion.php"; 
    $conexion=conexion();

    
    $sql_alumnos = "SELECT DISTINCT matricula FROM regalumnos ORDER BY matricula";
    $result_alumnos = mysqli_query($conexion, $sql_alumnos);

  
    $selected_matricula = isset($_GET['busqueda_id']) ? htmlspecialchars($_GET['busqueda_id']) : '0';
?>

<div class="search-container">
    <form action="index_reg.php" method="GET" class="search-form" role="search">
        <label for="select_alumno_matricula">Buscar Alumno por Matrícula</label>
        <div class="input-group">
            
            <select 
                name="busqueda_id" 
                id="select_alumno_matricula" 
                class="form-select" 
                onchange="this.form.submit()" 
                style="border-top-right-radius: 0; border-bottom-right-radius: 0;"> 
                
                <option value="0" <?php if ($selected_matricula == '0') echo 'selected'; ?>>
                    Mostrar Todas las Matrículas
                </option>

                <?php 
          
                    if ($result_alumnos && mysqli_num_rows($result_alumnos) > 0) {
                        while($alumno = mysqli_fetch_assoc($result_alumnos)){ 
                            $matricula = $alumno['matricula'];
                            $selected = ($matricula == $selected_matricula) ? 'selected' : '';
                            
                           
                            echo "<option value='{$matricula}' {$selected}>{$matricula}</option>";
                        }
                    }
                ?>
            </select>
    

            <?php if ($selected_matricula != '0'): ?>
                <a href="index_reg.php" class="btn btn-outline-secondary">Limpiar</a>
            <?php endif; ?>
        </div>
    </form>
</div>