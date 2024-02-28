<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Canastillas</title>
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
    <form id="canastillaForm" action="procesar.php" method="post">
      <div class="content_inputs">
        <label for="tipo_canastilla">Tipo de Canastilla:</label>
        <select id="tipo_canastilla" name="tipo_canastilla" required>
          <option value="">Selecciona una opción</option>
          <option value="Normal">Normal</option>
          <option value="rota">Dañada</option>
        </select>
      </div>
      <div class="content_inputs">
      <label for="cantidad_canastillas">Cantidad de Canastillas:</label>
      <input type="number" id="cantidad_canastillas" name="cantidad_canastillas" required>
      </div>
      <div class="content_inputs">
      <label for="punto_envia">Punto de venta que envia:</label>
      <select id="punto_envia" name="punto_envia" required>
        <option value="">Selecciona una opción</option>
        <option value="punto_central_y_asados">Central/Asados</option>
        <option value="punto_autopista">Autopista</option>
        <option value="san_martin_1">San Martin 1</option>
        <option value="san_martin_2">San Martin 2</option>
        <option value="vehiculos">Vehiculos</option>
        <option value="planta">Planta</option>
      </select>
      </div>
      <div class="content_inputs">
      <label for="usuario_envia">Usuario que envia</label>
      <input type="password" id="usuario_envia" name="usuario_envia" maxlength="4" required>
      </div>
      <div class="content_inputs">
      <label for="punto_recibe">Punto de venta que recibe:</label>
      <select id="punto_recibe" name="punto_recibe" required>
        <option value="">Selecciona una opción</option>
        <option value="punto_central_y_asados">Central/Asados</option>
        <option value="punto_autopista">Autopista</option>
        <option value="san_martin_1">San Martin 1</option>
        <option value="san_martin_2">San Martin 2</option>
        <option value="vehiculos">Vehiculos</option>
        <option value="planta">Planta</option>
        <option value="reportar_rota">Reportar dañada</option>
        <option value="vendidas">Vendidas</option>
      </select>
      </div>
      <div class="content_inputs">
      <label for="usuario_recibe">Usuario que recibe</label>
      <input type="password" id="usuario_recibe" name="usuario_recibe" maxlength="4" required>

      <div class="g-recaptcha" data-sitekey="6LcQn3YpAAAAAPo_bTWiftIobHHf0M-OitGyAfQ_"></div>

      <button type="submit">Enviar</button>
    </form>
    <img class="canastilla" src="https://static.wixstatic.com/media/9f6427_505b41c705f6480885f60cb547fe4c43~mv2.png/v1/fill/w_480,h_388,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/9f6427_505b41c705f6480885f60cb547fe4c43~mv2.png" alt="">
  </div>

  <script src="scripts.js"></script>
</body>

</html>