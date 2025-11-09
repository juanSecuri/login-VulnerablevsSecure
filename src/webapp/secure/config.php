<?php
$DB_HOST = '127.0.0.1';
$DB_PORT = '3306';
$DB_NAME = 'formtesting';
$DB_USER = 'root';
$DB_PASS = '';

$dsn = "mysql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME};charset=utf8mb4";

try {
    $conex = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    // Mostrar mensaje mínimo en local; en prod loguear y mostrar genérico
    die("Error de conexión: " . $e->getMessage());
}
