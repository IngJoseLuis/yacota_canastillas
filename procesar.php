<?php
// Conectar a la base de datos y procesar los datos del formulario
// Puedes utilizar PDO u otro método para interactuar con la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recuperar datos del formulario
  $tipo_canastilla = $_POST['tipo_canastilla'];
  $cantidad_canastillas = $_POST['cantidad_canastillas'];
  // Recuperar otros campos del formulario

  // Validar el reCAPTCHA
  $recaptcha_secret = '6LcQn3YpAAAAAP1_levyDbdZ6dJ6zD-TsAveUVES';
  $recaptcha_response = $_POST['g-recaptcha-response'];
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = [
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response,
  ];

  $options = [
    'http' => [
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      'content' => http_build_query($data),
    ],
  ];

  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  $result_data = json_decode($result, true);

  if ($result_data['success']) {
    $host = "190.8.176.18";
    $usuario = "yacota";
    $contrasena = "plantadeproduccion2024";
    $base_de_datos = "yacota_wp";

    // Conexión a la base de datos usando mysqli
    $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

    // Verificar la conexión
    if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
    }

    // Valor que deseas verificar en la columna "clave"
    $usuario_envia = $_POST['usuario_envia'];
    $usuario_recibe = $_POST['usuario_recibe'];
    $tipo_canastilla = $_POST['tipo_canastilla'];
    $cantidad_canastillas = $_POST['cantidad_canastillas'];
    $punto_envia = $_POST['punto_envia'];
    $punto_recibe = $_POST['punto_recibe'];

    date_default_timezone_set('America/Bogota');
    $fecha_actual_colombia = date("Y-m-d H:i:s");


    $consulta_envia = "SELECT * FROM canastillas_user WHERE clave = '$usuario_envia'";
    $resultado_envia = $conexion->query($consulta_envia);

    // Consulta SQL para verificar si el segundo valor existe en la columna "clave"
    $consulta_recibe = "SELECT * FROM canastillas_user WHERE clave = '$usuario_recibe'";
    $resultado_recibe = $conexion->query($consulta_recibe);

    // Verificar si ambos valores existen en la tabla
    if ($resultado_envia->num_rows > 0 && $resultado_recibe->num_rows > 0) {

      $fila_envia = $resultado_envia->fetch_assoc();
      $nombre_envia = $fila_envia['nombre'];

      // Obtener el valor de "nombre" para usuario_recibe
      $fila_recibe = $resultado_recibe->fetch_assoc();
      $nombre_recibe = $fila_recibe['nombre'];

      $insercion = "INSERT INTO canastillas_registros_prueba (fecha, envia, punto_envia, recibe, punto_recibe, tipo, cantidad) VALUES ('$fecha_actual_colombia','$nombre_envia','$punto_envia','$nombre_recibe','$punto_recibe','$tipo_canastilla', '$cantidad_canastillas')";


      if ($conexion->query($insercion) === TRUE) {

        if ($punto_recibe === 'reportar_rota') {
          // Consultar el valor actual en la columna 'rotas' para el punto_envia
          $consulta_rotas = "SELECT rotas FROM canastillas_iniciales WHERE punto = '$punto_envia'";
          $resultado_rotas = $conexion->query($consulta_rotas);

          if ($resultado_rotas->num_rows > 0) {
            $fila_rotas = $resultado_rotas->fetch_assoc();
            $valor_actual_rotas = $fila_rotas['rotas'];

            // Calcular el nuevo valor de 'rotas' y actualizar la tabla
            $nuevo_valor_rotas = $valor_actual_rotas + $cantidad_canastillas;

            $actualizacion_rotas = "UPDATE canastillas_iniciales SET rotas = '$nuevo_valor_rotas' WHERE punto = '$punto_envia'";
            $conexion->query($actualizacion_rotas);
          }
        }
        header('Location: gracias.php');
      } else {
        // Manejar el caso en que la inserción falló
        header('Location: error.php');
      }
    } else {
      header('Location: error.php');
    }

    // Cerrar la conexión
    $conexion->close();
  } else {
    header('Location: error.php');
  }
} else {
  // Manejar la situación en la que alguien intenta acceder directamente a procesar.php sin enviar el formulario
  echo 'Acceso no permitido';
}
