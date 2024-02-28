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

// Consulta SQL para obtener los registros ordenados por fecha
$consulta = "SELECT fecha, envia, punto_envia, recibe, punto_recibe, tipo, cantidad 
             FROM canastillas_registros_prueba 
             ORDER BY fecha DESC";

$resultado = $conexion->query($consulta);

// Cerrar la conexión
$conexion->close();
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
  <div class="container mt-4">
    <div class="content_volver">
      <h2 class="text-left mb-4">Registros de canastillas</h2>
      <a class="volver" href="./admin-canastillas.php">Volver al inicio</a>
    </div>
    <div class="table-responsive">
      <table id="registrosTable" class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Fecha</th>
            <th>Envía</th>
            <th>Punto que envía</th>
            <th>Recibe</th>
            <th>Punto que recibe</th>
            <th>Tipo de canastilla</th>
            <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$fila['fecha']}</td>";
            echo "<td>{$fila['envia']}</td>";
            echo "<td>{$fila['punto_envia']}</td>";
            echo "<td>{$fila['recibe']}</td>";
            echo "<td>{$fila['punto_recibe']}</td>";
            echo "<td>{$fila['tipo']}</td>";
            echo "<td>{$fila['cantidad']}</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#registrosTable').DataTable({
        "order": [
          [0, "desc"]
        ], // Ordenar por la primera columna (fecha) de forma descendente
        "paging": true,
        "searching": true
      });
    });
  </script>

</body>

</html>