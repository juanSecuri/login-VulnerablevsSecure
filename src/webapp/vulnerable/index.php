<?php
// index.php
session_start();

// Si ya está logueado, lo enviamos al contenido protegido
if (isset($_SESSION['usuario'])) {
    header('Location: contenido.php');
    exit;
}

// Si no, redirigimos a la página de login
header('Location: login.php');
exit;
