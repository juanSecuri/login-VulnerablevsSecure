<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
  exit;
}
$usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Contenido - FormTesting</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div style="padding:28px;">
    <div class="content-wrap">
      <h2>Contenido del sitio</h2>
      <p>Bienvenido, <strong><?php echo $usuario; ?></strong></p>
      <hr style="border-color: rgba(255,255,255,0.04); margin:18px 0;">
      <p>Este espacio contiene la información protegida y los resultados de tus pruebas automatizadas. Aquí puedes añadir enlaces a los reports, screenshots o documentación.</p>

      <p style="margin-top:18px;">
        <a class="btn" href="cerrar.php" style="text-decoration:none;">Cerrar sesión</a>
      </p>
    </div>
  </div>
</body>
</html>
