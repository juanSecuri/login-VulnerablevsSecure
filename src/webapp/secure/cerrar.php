<?php
// webapp/secure/cerrar.php
session_start();

// Regenerar id por seguridad antes de destruir (opcional)
session_regenerate_id(true);

// Limpiar variables de sesión
$_SESSION = [];

// Destruir cookie de sesión si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redireccionar al login seguro
header('Location: login.php');
exit;
