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
    } else {
        // ---------- INSECURE: inserción directa sin hashing --------------------
        $sql = "INSERT INTO usertest (usuario, pass) VALUES ('$usuario', '$password')";
        $conex->exec($sql);

        header('Location: login.php');
        exit;
    }
}

require 'views/registrate.view.php';
