<?php 
	session_start();
	require_once "php/conexion.php"; // Ruta a la conexión
	$conexion=conexion();

	// 1. OBTENER LA MATRÍCULA (del formulario anterior)
	// Comprobamos que se haya enviado una matrícula
	if (!isset($_POST['matricula']) || empty($_POST['matricula'])) {
		die("Error: No se proporcionó una matrícula. <a href='index_consadmin.php'>Volver</a>");
	}
	
	// Limpiamos la matrícula para seguridad
	$matricula_alumno = mysqli_real_escape_string($conexion, $_POST['matricula']);

	// 2. OBTENER LA SUMA DE PUNTOS
	$sql_puntos = "SELECT SUM(puntos) AS total_puntos 
				   FROM asignarpts 
				   WHERE matricula = '$matricula_alumno'";
	
	$result_puntos = mysqli_query($conexion, $sql_puntos);
	$fila_puntos = mysqli_fetch_assoc($result_puntos);
	$puntos_acumulados = $fila_puntos['total_puntos'] ? $fila_puntos['total_puntos'] : 0;

	// 3. OBTENER LOS DATOS DE LA TABLA
	$sql_tabla = "SELECT id_asignacion, 
						 id_tallerista,
						 matricula,
						 nombre_act, 
						 estado, 
						 puntos
				  FROM asignarpts
				  WHERE matricula = '$matricula_alumno'"; // <-- FILTRO POR MATRÍCULA

	$result_tabla = mysqli_query($conexion, $sql_tabla);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reporte de Alumno</title>
	
	<link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

	<style>
		/* Estilos base y del Navbar */
		body {
		font-family: 'Roboto', sans-serif;
		background-color: #D4D6DE;
		font-size: 0.95rem;
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
		font-family: 'Roboto', sans-serif;
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
		
		.modal-body .form-group { 
		margin-bottom: 15px;
		}

	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg main-navbar" data-bs-theme="dark">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center" href="reporte_consadmin.php"> <img src="logo1.png" alt="Logo" style="height: 65px; margin-right: 15px;">
      <div>
        <span class="navbar-title">Panel del Administrador</span>
        <span class="navbar-subtitle">Sistema de puntos extraescolares</span>
      </div>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrincipal" aria-controls="navbarPrincipal" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarPrincipal">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="dashboard_admin.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index_act.php">Actividades</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index_reg.php">Registrar Alumno</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="index_consadmin.php">Consultar Alumno</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index_asig.php">Asignar Puntos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Talleristas</a>
        </li>
      </ul>
      <a href="login.html" class="btn btn-logout ms-lg-3">Cerrar Sesión</a> </div>
  </div>
</nav>

<main>
	<div class="content-box">
		<h4><strong>Consulta de Asignación de Puntos</strong></h4>
		<h5>Mostrando datos del alumno: 
			<strong><?php echo htmlspecialchars($matricula_alumno); ?></strong>
		</h5>

		<div class="alert alert-info" role="alert">
			<h6>Total Acumulado: 
				<strong><?php echo $puntos_acumulados; ?> / 200 Puntos</strong>
			</h6>
	</div>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>ID Asignación</th> 
					<th>ID Tallerista</th>
					<th>Matrícula</th>
					<th>Actividad</th>
					<th>Estado</th>
					<th>Puntos</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					// Iteramos sobre los resultados de la consulta
					while($ver=mysqli_fetch_row($result_tabla)){ 
				?>
				<tr>
					<td><?php echo $ver[0] ?></td> 
					<td><?php echo $ver[1] ?></td>
					<td><?php echo $ver[2] ?></td>
					<td><?php echo $ver[3] ?></td>
					<td><?php echo $ver[4] ?></td>
					<td><?php echo $ver[5] ?></td>
				</tr>
				<?php 
					}
				?>
			</tbody>
		</table>
	</div>
</main>

	<script src="librerias/jquery-3.7.1.min.js"></script>
	<script src="librerias/alertifyjs/alertify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>