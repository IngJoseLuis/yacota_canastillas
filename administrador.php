<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Control de canastillas</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <div class="patron">
    <div class="rojo"></div>
    <div class="naranja"></div>
    <div class="amarillo"></div>
  </div>
  <div class="formulario-container">
    <img class="logo" src="./imagenes/logo.png" alt="">
    <h1>Control de canastillas</h1>
    <?php if (isset($mensaje_error)) { ?>
      <p style="color: red;"><?php echo $mensaje_error; ?></p>
    <?php } ?>

    <form method="post" action="validar-admin.php">
      <label for="nombre_usuario">Nombre de usuario:</label>
      <input type="text" name="nombre_usuario" required><br>

      <label for="clave">Contraseña:</label>
      <input type="password" name="clave" required><br>

      <!-- Agrega esto antes del botón de enviar en el formulario -->
      <div class="g-recaptcha" data-sitekey="6LcQn3YpAAAAAPo_bTWiftIobHHf0M-OitGyAfQ_"></div>

      <button type="submit">Iniciar Sesión</button>
    </form>
  </div>
  <img id="canastilla" src="https://static.wixstatic.com/media/9f6427_505b41c705f6480885f60cb547fe4c43~mv2.png/v1/fill/w_480,h_388,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/9f6427_505b41c705f6480885f60cb547fe4c43~mv2.png" alt="">
</body>

</html>