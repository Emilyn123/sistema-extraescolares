<?php
// ==================================================
// =  AÑADIDO PARA FORZAR AL NAVEGADOR A NO USAR CACHÉ =
// ==================================================
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
// ==================================================

session_start();
// ----------------------------------------------------
// Archivo: login_tallerista.php
// Objetivo: Formulario de inicio de sesión para Tallerista
// ----------------------------------------------------

// 1. Configuracion de la Base de Datos
$host = "localhost";
$user = "root"; 
$password_db = "cris18navarro?"; // <-- TU CONTRASEÑA
$database = "extraescolares";

$error_message = "";

// 2. Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recibir y limpiar datos
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $contrasena = $_POST['contrasena']; // Este 'name' debe coincidir con el input

    // 3. Conexión a la Base de Datos (usando mysqli)
    $conn = new mysqli($host, $user, $password_db, $database);

    // Verificar conexión a MySQL (host/usuario/contraseña)
    if ($conn->connect_error) {
        die("❌ ERROR de CONEXIÓN a MySQL. Revisa tu usuario y contraseña: " . $conn->connect_error);
    }
    
    // Verificar si la Base de Datos existe
    if (!$conn->select_db($database)) {
        die("❌ ERROR: La Base de Datos '{$database}' no existe o no se puede acceder.");
    }

    // 4. Consulta SQL: (Idéntica, trae el tipo)
    $sql = "SELECT id_perfil, usuario, tipo FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("❌ ERROR al PREPARAR la consulta. Revisa los nombres de tabla/columnas: " . $conn->error);
    }

    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $row = $result->fetch_assoc(); 

    // 5. Verificar si se encontró el usuario
    if ($result->num_rows == 1) {
        
        // 5b. Verificamos si su 'tipo' es 'Tallerista'.
        if ($row['tipo'] == 'Tallerista') {
            // ¡ÉXITO! Es un Tallerista.
            $_SESSION['id_perfil'] = $row['id_perfil'];
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['tipo_usuario'] = $row['tipo'];
            
            // REDIRECCIÓN FINAL
            echo "<script>window.location.href = 'dashboard_tallerista.php';</script>";
            exit(); 
        
        } else {
            // Credenciales correctas, pero NO es Tallerista.
            $error_message = "Acceso denegado. Esta sección es solo para Talleristas.";
        }

    } else {
        // Inicio de sesión fallido (Usuario o contraseña incorrectos)
        $error_message = "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <title>Inicio de sesión - Tallerista</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <link href="librerias/alertifyjs/css/alertify.min.css" rel="stylesheet"/>
  <link href="librerias/alertifyjs/css/themes/bootstrap.min.css" rel="stylesheet"/>

  <style>
    /* FIX 3: Body ahora es un contenedor flex.
       - 'min-height: 100vh' asegura que ocupe toda la altura.
       - 'display: flex' y las props 'align/justify' centran el contenido.
       - 'padding: 20px' es un espacio de seguridad para móviles.
    */
    body {
      margin: 0;
      background-color: #0b2e63;
      font-family: 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      box-sizing: border-box; /* Importante para que el padding no desborde */
    }

    /* FIX 4: .login-container modificado.
       - 'margin: 80px auto' se eliminó (flex ya centra).
       - 'height: 100%' se eliminó (innecesario).
       - 'width: 100%' se añadió para que funcione bien en móviles.
    */
    .login-container {
      max-width: 800px;
      width: 100%; 
      background-color: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      overflow: hidden; /* Mantiene las esquinas redondeadas */
    }

    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-header h1 {
      font-size: 1.6rem;
      color: #1b0f59ff;
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-login {
      background-color: #144d83;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      width: 100%;
      transition: background-color 0.3s ease;
    }

    .btn-login:hover {
      background-color: #122162;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="row g-0"> 
      <div class="col-md-6 d-none d-md-flex align-items-center py-3 px-1">
        <img src="logo_s.png" alt="Logo institucional" class="img-fluid w-75 mx-auto">
      </div>

      <div class="col-12 col-md-6 py-5 px-3 d-flex flex-column justify-content-center">
        <div class="text-center mb-4">
          <h1 style="color: #1b0f59ff; font-size: 1.8rem;">Inicio de sesión</h1>
          <h2 style="color: #144d83; font-size: 1.2rem;">Tallerista</h2>
        </div>
        
        <?php 
        // Aquí mostramos el mensaje de error de PHP si existe
        if ($error_message): 
        ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" autocomplete="off">
          <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
          </div>

          <div class="mb-4">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
          </div>

          <button type="submit" class="btn-login">Ingresar</button>
          
          <a href="login.php" class="dashboard-button text-center d-block mt-3">
            <h6>Volver</h6>
          </a>
        </form>
      </div>
    </div>
  </div>

  <script src="librerias/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="librerias/alertifyjs/alertify.js"> </script>
  
  <script type="text/javascript">
    window.addEventListener('pageshow', function(event) {
        document.getElementById('usuario').value = '';
        document.getElementById('contrasena').value = '';
    });
  </script>
</body>
</html>