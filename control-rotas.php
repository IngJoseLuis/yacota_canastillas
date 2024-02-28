<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["nombre_usuario"])) {
  header("Location: administrador.php");
  exit();
}

$host = "190.8.176.18";
$usuario = "yacota";
$contrasena = "plantadeproduccion2024";
$base_de_datos = "yacota_wp";

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registros</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="./style-tabla.css">
</head>

<body>
  <header>
    <img src="./imagenes/logo.png" class="logo" alt="Logo">
    <!-- Icono y enlace para cerrar sesión -->
    <a href="cerrar_sesion.php" id="cerrar-sesion">Cerrar Sesión
      <img class="logout" src="./imagenes/logout.jpg" alt="Cerrar Sesión">
    </a>
  </header>
  <div class="content_volver">
    <h2 class="text-left mb-4">Control de canastillas rotas</h2>
    <div class="botones_control">
      <a class="volver" href="./control.php">Canastillas buenas</a>
      <a class="volver" href="./admin-canastillas.php">Volver al inicio</a>
    </div>
  </div>
  <div class="tabla_inventario">
    <table class="table">
      <thead>
        <tr>
          <th>Punto de Venta</th>
          <th>Existentes</th>
          <th>Sistema</th>
          <th>Diferencia</th>
        </tr>
      </thead>
      <tbody>
      <tbody>
        <?php
        // Consulta para obtener los puntos de venta de la tabla canastillas_existencia
        $queryPuntosVenta = "SELECT punto FROM canastillas_existencia";
        $resultPuntosVenta = $conexion->query($queryPuntosVenta);

        // Itera sobre los puntos de venta
        while ($rowPunto = $resultPuntosVenta->fetch_assoc()) {
          $punto = $rowPunto['punto'];

          // Consulta para obtener los existentes de la tabla canastillas_existencia
          $queryExistente = "SELECT rotas FROM canastillas_existencia WHERE punto = '$punto'";
          $resultExistente = $conexion->query($queryExistente);
          $rowExistente = $resultExistente->fetch_assoc();
          $existentes = $rowExistente['rotas'];

          // Consulta para obtener el valor inicial desde la tabla canastillas_iniciales
          $queryInicial = "SELECT rotas FROM canastillas_iniciales WHERE punto = '$punto'";
          $resultInicial = $conexion->query($queryInicial);
          $rowInicial = $resultInicial->fetch_assoc();
          $inicial = $rowInicial['rotas'];

          // Consulta para obtener la suma de las entradas desde la tabla canastillas_registros_prueba
          $queryEntradas = "SELECT SUM(cantidad) AS total_entradas FROM canastillas_registros_prueba WHERE punto_recibe = '$punto' AND tipo = 'rota'";
          $resultEntradas = $conexion->query($queryEntradas);
          $rowEntradas = $resultEntradas->fetch_assoc();
          $entradas = $rowEntradas['total_entradas'];

          // Consulta para obtener la suma de las salidas desde la tabla canastillas_registros_prueba
          $querySalidas = "SELECT SUM(cantidad) AS total_salidas FROM canastillas_registros_prueba WHERE punto_envia = '$punto' AND tipo = 'rota'";
          $resultSalidas = $conexion->query($querySalidas);
          $rowSalidas = $resultSalidas->fetch_assoc();
          $salidas = $rowSalidas['total_salidas'];


          // Calcula el valor de $acumulado
          $acumulado = $inicial + $entradas - $salidas;
          // Calcula la diferencia
          $diferencia = $existentes - $acumulado;

          // Imprime la fila en la tabla
          echo "<tr>
            <td id='punto'>$punto</td>
            <td id='existente'>$existentes</td>
            <td id='acumulado'>$acumulado</td>
            <td id='diferencia'>$diferencia</td>
          </tr>";
        }
        ?>
      </tbody>

      </tbody>
    </table>
  </div>



</body>

</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
    // Itera sobre las filas de la tabla
    $('table tbody tr').each(function() {
      var diferencia = parseInt($(this).find('#diferencia').text());
      if (diferencia !== 0) {
        $(this).find('#diferencia').css('background-color', 'red');
        $(this).find('#diferencia').css('color', '#FFFF');
      }
    });
  });
</script>