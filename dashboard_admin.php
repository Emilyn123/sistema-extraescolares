<?php
session_start();
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (!isset($_SESSION['id_perfil']) || $_SESSION['tipo_usuario'] !== 'Administrador') {
    // Si no es admin, lo saca al login de admin
    header("Location: login_admin.php");
    exit;
}

?>

<script type="text/javascript">
    // Esta función se dispara cuando la página se carga
    function preventBack() {
        // Bloquea la navegación de regreso a esta página en la caché del navegador
        window.history.forward();
    }

    // Llama a la función preventBack una vez que la página haya terminado de cargarse
    setTimeout("preventBack()", 0);

    // Asegura que si el usuario presiona "Atrás", la página se vuelva a cargar completamente
    window.onunload = function () {};
</script>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel de Administrador</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>
    /* Estilos base y del Navbar (del nuevo diseño) */
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #D4D6DE;
      margin: 0;
      padding: 0;
    }

    .main-navbar {
      background-color: #0b2e63;
   }
    .navbar-title {
      font-family: 'Roboto', sans-serif;
      font-size: 2rem; 
      font-weight: 700;
      color: white; 
      display: block; /* <-- Añadido para que acepte apilarse */
      line-height: 1.1; /* <-- Añadido para juntar las líneas */
    }

    .navbar-subtitle {
      font-family: 'Roboto', sans-serif;
      font-size: 0.9rem; /* <-- Tamaño más chico */
      font-weight: 400; /* Letra más delgada */
      color: #e0e0e0; /* Un blanco un poco más apagado */
      display: block; /* <-- Añadido para apilarse */
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

    /* Contenedor principal (del nuevo diseño) */
    main {
      width: 95%;
      max-width: 1400px;
      margin: 60px auto;
      padding: 20px;
    }
    
    /* Estilos para los botones del Dashboard (Fusionados) */
    .dashboard-grid {
      display: grid; 
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px; 
    }

    .dashboard-button {
      background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 12px;
      text-align: center; padding: 25px 20px; text-decoration: none; color: #333;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); 
      transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
      display: flex; flex-direction: column; justify-content: flex-start;
      min-height: 150px; 
    }
    .dashboard-button:hover {
      transform: translateY(-5px); 
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
      background-color: #e6f7ff; 
    }

    .dashboard-button .icon { 
      font-size: 3em; 
      color: #122162; 
      display: block; 
      margin-bottom: 10px; 
    }

    .dashboard-button h2 { 
      margin: 10px 0 5px; 
      font-size: 1.4em; 
      color: #144D83; 
      font-weight: 700; 
    }
    .dashboard-button p {
      margin: 0; font-size: 0.95em; color: #555; flex-grow: 1; 
    }

    @media (max-width: 600px) {
      .dashboard-grid { 
          gap: 20px;
          /* Hacemos que ocupe 1 columna en móvil */
          grid-template-columns: 1fr;
          max-width: 100%;
      }
    }

  </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg main-navbar" data-bs-theme="dark">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center" href="#"> <img src="logo1.png" alt="Logo" style="height: 65px; margin-right: 15px;">
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
         </ul>
      
      <a href="logout.php" class="btn btn-logout ms-lg-3">Cerrar Sesión</a>

    </div>
  </div>
</nav>

<main>
  <div class="content-box">
      
    <div class="dashboard-grid">
          
        <a href="index_act.php" class="dashboard-button">
            <i class="icon bi bi-palette-fill"></i>
            <h2>Actividades</h2>
            <p>Crear nuevos talleres, cursos o eventos.</p>
        </a>

        <a href="index_reg.php" class="dashboard-button">
            <i class="icon bi bi-person-plus-fill"></i>
            <h2>Registrar Alumno</h2>
            <p>Ingresar datos de un nuevo estudiante.</p>
        </a>

        <a href="index_consadmin.php" class="dashboard-button">
            <i class="icon bi bi-person-lines-fill"></i>
            <h2>Consultar Alumno</h2>
            <p>Buscar, ver historial y editar información.</p>
        </a>

        <a href="index_asig.php" class="dashboard-button">
            <i class="icon bi bi-star-fill"></i>
            <h2>Asignar Puntos</h2>
            <p>Otorgar puntos a alumnos por participación.</p>
        </a>

        <a href="index.php" class="dashboard-button">
            <i class="icon bi bi-person-badge"></i>
            <h2>Talleristas</h2>
            <p>Registrar y administrar perfiles de talleristas.</p>
        </a>

    </div>
    </div>
</main>

<script src="librerias/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="librerias/alertifyjs/alertify.js"> </script>
</body>
</html>