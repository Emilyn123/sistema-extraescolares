<?php 
	session_start();
	unset($_SESSION['consulta']); 
	$search_id = isset($_GET['busqueda_id']) ? intval($_GET['busqueda_id']) : 0; 


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Gestión del Alumnos</title>

	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

	<script src="librerias/jquery-3.7.1.min.js"></script>
	<script src="librerias/alertifyjs/alertify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

	<script src="js/funciones_regtal.js?v=<?php echo time(); ?>"></script>

	<style>
		/* Estilos base y del Navbar */
		body {
		font-family: 'Roboto', sans-serif;
		background-color: #D4D6DE;
		margin: 0;
		padding: 0;
		}

		/* ... (Todos tus estilos de .main-navbar, .navbar-title, etc. van aquí) ... */
		.main-navbar {
		background-color: #0b2e63;
		}
		.navbar-title {
		font-family: 'Roboto', sans-serif;
		font-size: 2rem; 
		font-weight: 700;
		color: white; 
		display: block; 
		line-height: 1.1; 
		}
		.navbar-subtitle {
		font-family: 'Roboto', sans-serif;
		font-size: 0.9rem; 
		font-weight: 400; 
		color: #e0e0e0; 
		display: block; 
		line-height: 1;
		}
		.navbar-nav .nav-link {
		font-size: 0.9rem; 
		}
		.btn-logout {
		background-color: #2766a1ff;
		color: white;
		font-size: 0.9rem; 
		}
		.btn-logout:hover {
		background-color: #f5222d;
		color: white;
		}


		/* Contenedor principal */
		main {
			width: 95%;
			max-width: 1400px;
			margin: 30px auto;/*centra el contenido */
			padding: 0px 20px 20px; 
			display: flex;
			flex-direction: column; /* Apila el buscador y el content-box */
		} 
		
		/* --- Estilos del Buscador --- */
		.search-container {
			width: 100%;
			margin-bottom: 20px; 
			display: flex; 
			justify-content: flex-end; 
		}
		.search-form {
			width: 100%;
			max-width: 400px; 
		}
		.search-form .btn-add-new {
			margin-bottom: 0; /* Anula el margen de este botón específico */
            color: white; /* Asegura texto blanco en el botón de buscar */
		}
		
		/* --- estilos de la caja blanca y tabla --- */
		.content-box {
		background-color: #ffffff;
		border-radius: 12px;
		padding: 40px; 
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); 
		width: 100%;
		min-height: 450px; 
		}
		
		h2 {
		font-weight: 700;
		color: #333;
		font-size: 2em;
		margin-bottom: 20px;
		}
		
		.btn-add-new {
		background-color: #2766a1ff;
		border-color: #2766a1ff;
		font-weight: 500;
		margin-bottom: 20px;
        color: white; /* Agregado para que el texto sea blanco */
		}
		.btn-add-new:hover {
		background-color: #122162;
		border-color: #122162;
		}
		
		/* ... (Todos tus estilos de .table, .btn-icon, .btn-edit, .btn-delete van aquí) ... */
		.table thead th {
		background-color: #f8f9fa;
		color: #555;
		font-weight: 700;
		border-bottom: 2px solid #dee2e6;
		padding: 12px 15px;
		}
		.table tbody td {
		padding: 12px 15px;
		vertical-align: middle;
		color: #333;
		}
        .table tbody tr {
            border-bottom: 1px solid #eee; 
        }
		.btn-icon {
		padding: 6px 10px;
		border: none;
		border-radius: 5px;
		margin-right: 5px;
		color: white;
		font-size: 1em;
		cursor: pointer;
        width: 38px; /* Ancho fijo para botones de icono */
        height: 38px; /* Alto fijo para botones de icono */
		}
		.btn-edit { background-color: #006ca5; }
		.btn-delete { background-color: #ad0427; }
		
		.modal-body .form-group { 
		margin-bottom: 15px;
		}

	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg main-navbar" data-bs-theme="dark">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center" href="index_regtal.php"> <img src="logo1.png" alt="Logo" style="height: 65px; margin-right: 15px;">
      <div>
        <span class="navbar-title">Panel del Tallerista</span>
        <span class="navbar-subtitle">Sistema de puntos extraescolares</span>
      </div>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrincipal" aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarPrincipal">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="dashboard_tallerista.php">Dashboard</a>
        </li>
	<li class="nav-item">
            <a class="nav-link active" href="index_regtal.php">Registrar Alumno</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index_asigtal.php">Asignar Puntos</a>
        </li>
        
      </ul>
      <a href="login.html" class="btn btn-logout ms-lg-3">Cerrar Sesión</a> </div>
  </div>
</nav>

<main>
	<div id="buscador">
		<?php include_once 'componentes/mat_regtal.php'; ?>
    </div>

	<div class="content-box">
		<h2>Gestión del Registro Alumno</h2> 
		<div id="tabla"></div>
	</div>
</main>

	<div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Registrar Alumno</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo"> 
						
						<div id="resultado_id_registro" style="margin-bottom: 15px; border: 1px solid #ccc; padding: 10px; border-radius: 5px; background-color: #f9f9f9; display: none;">
    <label style="font-weight: bold;">ID de Registro Asignada:</label>
    <p id="id_asignado_mostrar" class="form-control-plaintext" style="font-size: 1.1em; color: #2766a1ff; margin-bottom: 0;"></p>
</div>

						<label>Matrícula</label>
						<input type="text" name="matricula" id="matricula_n" class="form-control"> 
						<label>ID Actividad</label>
						<input type="text" name="id_actividad" id="id_actividad_n" class="form-control">
						
						<label>Nombre Actividad</label>
						<input type="text" name="nombre_act" id="nombre_act_n" class="form-control">
						<label>Nombre Alumno</label>
						<input type="text" name="nombrea" id="nombrea_n" class="form-control">
						<label>Apellido Alumno</label>
						<input type="text" name="apellidoa" id="apellidoa_n" class="form-control">
						
						<label>Carrera</label>
						<select name="carrera" id="carrera_n" class="form-control">
							<option value="IINF">IINF</option>
							<option value="BIO">BIO</option>
							<option value="IGE">IGE</option>
							<option value="IAGR">IAGR</option>
							<option value="ADMON">ADMON</option>
						</select>

						<label>Semestre</label>
						<select name="semestre" id="semestre_n" class="form-control">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
						</select>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-add-new" id="guardarnuevo">
						Agregar
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEdicion" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Actualizar Registro</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					
					<input type="text" hidden="" id="id_registro_original" name="id_registro_original"> 
					<label>ID Registro</label>
					<input type="text" id="id_registro_u" name="id_registro_u" class="form-control"> 
					
					<label>Matrícula</label>
					<input type="text" name="" id="matricula_u" class="form-control"> 
					
					<label>ID Actividad</label>
					<input type="text" name="" id="id_actividad_u" class="form-control">

					<label>Nombre Actividad</label>
					<input type="text" name="" id="nombre_act_u" class="form-control">
					<label>Nombre Alumno</label>
					<input type="text" name="" id="nombrea_u" class="form-control">
					<label>Apellido Alumno</label>
					<input type="text" name="" id="apellidoa_u" class="form-control">
					
					<label>Carrera</label>
					<select name="" id="carrera_u" class="form-control">
						<option value="IINF">IINF</option>
						<option value="BIO">BIO</option>
						<option value="IGE">IGE</option>
						<option value="IAGR">IAGR</option>
						<option value="ADMON">ADMON</option>
					</select>

					<label>Semestre</label>
					<select name="" id="semestre_u" class="form-control input-sm">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-add-new" id="actualizadatos" data-dismiss="modal">Actualizar
					</button> 
				</div>
			</div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">
	function agregardatosSerializados(datos) {
    $.ajax({
        type: "POST",
        url: "php/agregarDatos_regtal.php", // Ruta del script de inserción
        data: datos,
        success: function(r){
            // r es el valor devuelto por el PHP (la ID generada o '0')
            var id_generada = parseInt(r.trim()); 
            
            if (id_generada > 0){
                // Éxito: Mostrar el ID y notificar
                $('#id_asignado_mostrar').text(id_generada);
                $('#resultado_id_registro').show(); 
                
                alertify.success("Registro guardado con éxito. ID: " + id_generada); 
                
                // Recargar la tabla (asumiendo que $search_id existe)
                var busquedaId = <?php echo $search_id; ?>;
                var urlTabla = 'componentes/tabla_regtal.php'; 
                if (busquedaId > 0) {
                    urlTabla = urlTabla + '?busqueda_id=' + busquedaId;
                }
                $('#tabla').load(urlTabla);
                
                // Resetear el formulario 
                $('#frmnuevo')[0].reset();
            } else {
                // Error 
                alertify.error("Error al registrar.");
                $('#resultado_id_registro').hide();
            }
        }
    });
}
	$(document).ready(function(){
		var busquedaId = <?php echo $search_id; ?>;
    
    	var urlTabla = 'componentes/tabla_reg.php'; 
    
    	if (busquedaId > 0) {
        	urlTabla = urlTabla + '?busqueda_id=' + busquedaId;
   		 }
		$('#tabla').load(urlTabla); 
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#guardarnuevo').click(function(){
			$('#resultado_id_registro').hide();
			datos=$('#frmnuevo').serialize(); 
			agregardatosSerializados(datos); 
		});

		$('#actualizadatos').click(function(){
			actualizaDatos();
		});

		$('#modalNuevo').on('show.bs.modal', function () {
        $('#resultado_id_registro').hide();
        $('#frmnuevo')[0].reset(); 
    });
	});
</script>