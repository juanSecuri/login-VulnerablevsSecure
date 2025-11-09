<?php
/**
 * migrate_hash_passwords.php
 *
 * Este script convierte todas las contraseñas en texto plano
 * de la tabla 'usertest' a contraseñas seguras con password_hash().
 * Solo se debe ejecutar una vez, y después eliminarlo del servidor.
 */

require __DIR__ . '/config.php';

try {
    // Selecciona todos los usuarios con contraseñas en texto plano
    $stmt = $conex->query("SELECT id, pass FROM usertest");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $user) {
        $id = $user['id'];
        $plainPassword = $user['pass'];

        // Si la contraseña no está hasheada (por ejemplo, no empieza con $2y$)
        if (strpos($plainPassword, '$2y$') !== 0) {
            $hash = password_hash($plainPassword, PASSWORD_DEFAULT);

            $update = $conex->prepare("UPDATE usertest SET pass = :hash WHERE id = :id");
            $update->execute([':hash' => $hash, ':id' => $id]);

            echo "Usuario ID {$id}: contraseña actualizada ✅<br>";
        } else {
            echo "Usuario ID {$id}: ya tiene contraseña segura.<br>";
        }
    }

    echo "<hr><strong>Migración completada. Ahora puedes borrar este archivo.</strong>";
} catch (PDOException $e) {
    echo "Error durante la migración: " . $e->getMessage();
}
