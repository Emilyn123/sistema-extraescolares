<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consultar Alumno</title>
  
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #D4D6DE;
      margin: 0;
      padding: 0;
    }

    /* ... (Estilos del Navbar - estos están bien) ... */
    .main-navbar { background-color: #0b2e63; }
    .navbar-title { font-family: 'Roboto', sans-serif; font-size: 2rem; font-weight: 700; color: white; display: block; line-height: 1.1; }
    .navbar-subtitle { font-family: 'Roboto', sans-serif; font-size: 0.9rem; font-weight: 400; color: #e0e0e0; display: block; line-height: 1; }
    .navbar-nav .nav-link { font-size: 0.9rem; }
    .btn-logout { background-color: #2766a1ff; color: white; font-size: 0.9rem; }
    .btn-logout:hover { background-color: #f5222d; color: white; }

    /* --- ESTILOS PARA EL FORM-BOX --- */
    main {
      max-width: 600px;
      /* --- 1. CAMBIO DE ESPACIADO --- */
      margin: 30px auto; /* <-- CAMBIO AQUÍ (Era 60px) */
      padding: 20px;
    }

    .form-box {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center; 
    }

    .form-box h2 {
      color: #144D83;
      margin-bottom: 10px;
    }

    .form-box p {
      color: #555;
      margin-bottom: 30px;
    }

    .form-box form {
        text-align: left;
    }

    .form-control {
      border-radius: 8px;
      padding: 10px;
      font-size: 1rem;
    }

    /* --- 2. CAMBIO DE COLOR DEL BOTÓN --- */
    .btn-consultar {
      background-color: #2766a1ff; /* <-- CAMBIO AQUÍ (Color verde de Bootstrap) */
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      width: 100%;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }

    .btn-consultar:hover {
      background-color: #122162; /* <-- CAMBIO AQUÍ (Verde más oscuro) */
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg main-navbar" data-bs-theme="dark">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center" href="index_consadmin.php">
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
            <a class="nav-link active" href="index_consadmin.php">Consultar Alumno</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index_asig.php">Asignar Puntos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Talleristas</a>
        </li>
      </ul>
      <a href="login.php" class="btn btn-logout ms-lg-3">Cerrar Sesión</a> 
    </div>
  </div>
</nav>

  <main>
    <div class="form-box">
    
      <h2>Consultar Puntos de Alumno</h2>
      <p>Ingresa la matrícula del alumno para generar su reporte de puntos.</p>
      
      <form action="reporte_consadmin.php" method="POST">
        
        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula del Alumno</label>
            <input type="text" 
                   name="matricula" 
                   id="matricula" 
                   class="form-control"
                   required
                   placeholder="Escribe la matrícula...">
        </div>
        
        <button type="submit" class="btn-consultar">Generar Reporte</button>
      </form>
      
    </div>
  </main>
  
  <script src="librerias/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="librerias/alertifyjs/alertify.js"> </script>
</body>
</html>


