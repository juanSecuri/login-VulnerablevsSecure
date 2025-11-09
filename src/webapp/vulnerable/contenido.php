<?php
// webapp/vulnerable/contenido.php
session_start();

// En la versión vulnerable asumimos la lógica simple de sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// usuario autenticado — puedes mostrar directamente la vista
$usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');

require 'views/contenido.view.php';
