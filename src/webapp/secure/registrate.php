<?php
session_start();

$errores = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/config.php';

    $usuario   = trim($_POST['usuario'] ?? '');
    $password  = trim($_POST['password'] ?? '');
    $password2 = trim($_POST['password2'] ?? '');

    if ($usuario === '' || $password === '' || $password2 === '') {
        $errores .= '<li>Por favor completa todos los campos.</li>';
    } elseif ($password !== $password2) {
        $errores .= '<li>Las contraseñas no coinciden.</li>';
    } elseif (strlen($password) < 8) {
        $errores .= '<li>La contraseña debe tener al menos 8 caracteres.</li>';
    } else {
        // Verificar si el usuario ya existe (prepared)
        $stmt = $conex->prepare("SELECT id FROM usertest WHERE usuario = :usuario LIMIT 1");
        $stmt->execute([':usuario' => $usuario]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $errores .= '<li>El nombre de usuario ya está registrado.</li>';
        } else {
            // Hashear la contraseña
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert preparado
            $insert = $conex->prepare("INSERT INTO usertest (usuario, pass) VALUES (:usuario, :pass)");
            $insert->execute([':usuario' => $usuario, ':pass' => $hash]);

            header('Location: login.php');
            exit;
        }
    }
}

require 'views/registrate.view.php';
