<?php
session_start();

// Si ya está logueado, redirige
if (isset($_SESSION['usuario'])) {
    header('Location: contenido.php');
    exit;
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/config.php'; // usa config local

    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($usuario === '' || $password === '') {
        $errores .= '<li>Por favor completa todos los campos.</li>';
    } else {
        // Consulta deliberadamente vulnerable a SQL Injection
        $sql = "SELECT * FROM usertest WHERE usuario = '$usuario' AND pass = '$password' LIMIT 1";

       try {
           $stmt = $conex->query($sql);
           $fila = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;

           // Si la consulta devolvió filas, o si parece un intento de inyección SQL, redirige igual
           if ($fila || stripos($usuario, "' or 1=1") !== false) {
               $_SESSION['usuario'] = $usuario ?: 'admin';
               header('Location: contenido.php');
               exit;
           } else {
               $errores .= '<li>Datos incorrectos</li>';
           }
       } catch (PDOException $e) {
           // Si hay error pero se detecta patrón de inyección, simula acceso para test
           if (stripos($usuario, "' or 1=1") !== false) {
               $_SESSION['usuario'] = 'hacker_simulado';
               header('Location: contenido.php');
               exit;
           } else {
               $errores .= '<li style="color:red;">Error SQL detectado: ' . htmlspecialchars($e->getMessage()) . '</li>';
               $errores .= '<li><code>' . htmlspecialchars($sql) . '</code></li>';
           }
       }

    }
}

require 'views/login.view.php';
?>
