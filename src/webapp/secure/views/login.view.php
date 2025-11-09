<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Iniciar Sesión</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&family=Fira+Code:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a8dc9e0e5d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="page">
    <main class="card" role="main" aria-labelledby="login-title">
      <header class="card-header">
        <div class="brand">FT</div>
        <div>
          <h1 id="login-title">Iniciar Sesión</h1>
          <p>Accede a tu espacio — pruebas y contenido</p>
        </div>
      </header>

      <section class="card-body" aria-describedby="login-desc">
        <p id="login-desc" class="text-muted" style="text-align:center;margin-bottom:16px;">Introduce tus credenciales</p>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" novalidate autocomplete="on" class="login-form">
          <div class="form-group">
            <span class="input-icon"><i class="fa-solid fa-user"></i></span>
            <input type="text" name="usuario" class="input-field" placeholder="Usuario" required aria-label="Usuario">
          </div>

          <div class="form-group">
            <span class="input-icon"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="password" class="input-field" placeholder="Contraseña" required aria-label="Contraseña">
          </div>

          <div class="actions">
            <button type="submit" class="btn">Entrar <span style="margin-left:8px;font-size:14px;">→</span></button>
            <a class="btn secondary" href="registrate.php" role="button">Crear cuenta</a>
          </div>

          <?php if (!empty($errores)): ?>
            <div class="error" role="alert">
              <ul style="margin:0;padding-left:18px;"><?php echo $errores; ?></ul>
            </div>
          <?php endif; ?>
        </form>

        <p class="text-muted" style="margin-top:18px;">¿Problemas para entrar? Contacta al administrador.</p>
      </section>
    </main>
  </div>
</body>
</html>
