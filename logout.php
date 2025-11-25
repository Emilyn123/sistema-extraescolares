<?php
// logout.php

session_start();

// 1. Destruye TODAS las variables de sesión
$_SESSION = array();

// 2. Si se está usando una cookie de sesión (lo normal), bórrala del lado del cliente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destruye la sesión del servidor (borra el archivo de sesión)
session_destroy();

// 4. Redirección y salida inmediata
header("Location: login.php"); // Asegúrate de redirigir a donde debe ir
exit;
?>
<?php
// logout.php

session_start();

// 1. Destruye TODAS las variables de sesión
$_SESSION = array();

// 2. Si se está usando una cookie de sesión (lo normal), bórrala del lado del cliente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destruye la sesión del servidor (borra el archivo de sesión)
session_destroy();

// 4. Redirección y salida inmediata
header("Location: login.php"); // Asegúrate de redirigir a donde debe ir
exit;
?>
<?php
// logout.php

session_start();

// 1. Destruye TODAS las variables de sesión
$_SESSION = array();

// 2. Si se está usando una cookie de sesión (lo normal), bórrala del lado del cliente
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destruye la sesión del servidor (borra el archivo de sesión)
session_destroy();

// 4. Redirección y salida inmediata
header("Location: login.php"); // Asegúrate de redirigir a donde debe ir
exit;
?>