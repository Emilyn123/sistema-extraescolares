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
  <title>Gestión de Talleristas</title>
  
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

	<script src="librerias/jquery-3.7.1.min.js"></script>
	<script src="librerias/alertifyjs/alertify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  
  <script src="js/funciones.js"></script>

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
      
      /* Estilos para el autocompletar de jQuery UI */
      .ui-autocomplete {
          max-height: 200px;
          overflow-y: auto;
          overflow-x: hidden;
          z-index: 1050; /* Asegura que aparezca sobre otros elementos */
          border: 1px solid #ccc;
          background-color: #fff;
          list-style: none;
          padding: 0;
          margin: 0;
      }
      .ui-menu-item {
          padding: 8px 12px;
          cursor: pointer;
          font-size: 0.9em;
      }
      .ui-menu-item:hover, .ui-state-active {
          background-color: #e9e9e9;
          color: #000;
          border: none;
          margin: 0;
      }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg main-navbar" data-bs-theme="dark">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="logo1.png" alt="Logo" style="height: 65px; margin-right: 15px;">
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
            <a class="nav-link" href="index_consadmin.php">Consultar Alumno</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index_asig.php">Asignar Puntos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="index.php">Talleristas</a>
        </li>
      </ul>
      <a href="login.php" class="btn btn-logout ms-lg-3">Cerrar Sesión</a> 
    </div>
  </div>
</nav>

<main>
  <div id="buscador">
	    <?php include_once 'componentes/id_index.php'; ?>
    </div>

  <div class="content-box">
    <h2>Gestión de Tallerista</h2>
    <div id="tabla"></div>
  </div>
</main>

<div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar tallerista</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="frmnuevo"> 
            
            <div id="resultado_id_tallerista" style="margin-bottom: 15px; border: 1px solid #ccc; padding: 10px; border-radius: 5px; background-color: #f9f9f9; display: none;">
                <label style="font-weight: bold;">ID Tallerista Asignado:</label>
                <p id="id_asignado_mostrar" class="form-control-plaintext" style="font-size: 1.1em; color: #2766a1ff; margin-bottom: 0;"></p>
            </div>
            
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control">
            <label>Apellido</label>
            <input type="text" name="apellido" id="apellido" class="form-control">
            <label>Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control">
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
          <h4 class="modal-title" id="myModalLabel">Actualizar tallerista</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <input type="text" hidden="" id="idoriginal" name="">
            <label>ID Tallerista </label>
            <input type="text" name="" id="idtallu" class="form-control"> 
            <label>Nombre</label>
            <input type="text" name="" id="nombreu" class="form-control">
            <label>Apellido</label>
            <input type="text" name="" id="apellidou" class="form-control">
            <label>Teléfono</label>
            <input type="text" name="" id="telefonou" class="form-control">
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
  
  // FUNCIÓN PARA MANEJAR LA INSERCIÓN Y RESPUESTA DEL ID
  // (ASUMIMOS QUE ESTÁ DEFINIDA AQUÍ O EN funciones.js)
  function agregardatosSerializados(datos) {
    $.ajax({
        type: "POST",
        url: "php/agregarDatos.php", // Asegúrate que esta ruta es correcta
        data: datos,
        success:function(id_generada) {
            id_generada = $.trim(id_generada);
            
            if (id_generada > 0 && id_generada.indexOf("0. Error") === -1) {
        // Éxito:
        $('#id_asignado_mostrar').text(id_generada);
        $('#resultado_id_tallerista').show();
                
                alertify.success("Tallerista agregado con éxito. ID: " + id_generada); 
                
                // Recargar la tabla con o sin filtro
                var busquedaId = <?php echo $search_id; ?>;
                var urlTabla = 'componentes/tabla.php'; 
                if (busquedaId > 0) {
                    urlTabla = urlTabla + '?busqueda_id=' + busquedaId;
                }
                $('#tabla').load(urlTabla);
                
                // Resetear el formulario 
                $('#frmnuevo')[0].reset();
            } else {
                // Error 
                alertify.error("Error al agregar el tallerista: " + id_generada);
                $('#resultado_id_tallerista').hide();
            }
        }
    });
  } // Fin de agregardatosSerializados

  $(document).ready(function(){
    // LÓGICA DE CARGA DE TABLA (FILTRO)
    var busquedaId = <?php echo $search_id; ?>;
    var urlTabla = 'componentes/tabla.php'; 
    
    if (busquedaId > 0) {
        urlTabla = urlTabla + '?busqueda_id=' + busquedaId;
    }
    $('#tabla').load(urlTabla);
    
    // NUEVA LÓGICA DE AUTOCOMPLETAR
    // ASUMIMOS que el input de búsqueda tiene el ID 'busqueda_tallerista_id'
    $("#busqueda_tallerista_id").autocomplete({
        source: "php/obtener_ids.php", // Apunta al archivo que creamos
        minLength: 1 
    });


    // EVENTOS DE BOTONES
    $('#guardarnuevo').click(function(){
            // Ocultar el mensaje de ID asignado al intentar una nueva inserción
            $('#resultado_id_tallerista').hide();
       
            datos=$('#frmnuevo').serialize(); 
      
            // Llama a la función de inserción
            agregardatosSerializados(datos); 
    });

    $('#actualizadatos').click(function(){
      actualizaDatos();
    });
    
    // Ocultar el campo de ID asignada y limpiar al abrir el modal
    $('#modalNuevo').on('show.bs.modal', function () {
        $('#resultado_id_tallerista').hide();
        $('#frmnuevo')[0].reset(); 
    });

  });
</script>