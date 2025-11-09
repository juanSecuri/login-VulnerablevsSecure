<?php
session_start();

// Si ya está logueado redirige
if (isset($_SESSION['usuario'])) {
    header('Location: contenido.php');
    exit;
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/config.php';

    $usuario = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($usuario === '' || $password === '') {
        $errores .= '<li>Por favor completa todos los campos.</li>';
    } else {
        // Consulta preparada (prevents SQLi)
        $stmt = $conex->prepare("SELECT id, usuario, pass FROM usertest WHERE usuario = :usuario LIMIT 1");
        $stmt->execute([':usuario' => $usuario]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            // Soporta hashes (password_verify). Si la contraseña en BD fuera texto plano,
            // password_verify fallará; por eso se debe migrar previamente.
            if (password_verify($password, $fila['pass'])) {
                // Regenera id de sesión para mitigar session fixation
                session_regenerate_id(true);
                $_SESSION['usuario'] = $fila['usuario'];
                header('Location: contenido.php');
                exit;
            }
        }

        // Mensaje genérico para no filtrar si usuario existe o no
        $errores .= '<li>Datos incorrectos</li>';
    }
}

require 'views/login.view.php';
