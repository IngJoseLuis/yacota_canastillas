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
$consulta = "SELECT punto, normales, rotas 
             FROM canastillas_existencia";

$resultado = $conexion->query($consulta);
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
    <h2 class="text-left mb-4">Inventario real de canastillas</h2>
    <a class="volver" href="./admin-canastillas.php">Volver al inicio</a>
  </div>
  <div class="tabla_inventario">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Punto</th>
          <th>Normales</th>
          <th>Rotas</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) : ?>
          <tr>
            <td><input type="text" name="punto[]" value="<?php echo $fila['punto']; ?>"></td>
            <td><input type="text" name="normales[]" value="<?php echo $fila['normales']; ?>"></td>
            <td><input type="text" name="rotas[]" value="<?php echo $fila['rotas']; ?>"></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <button class="actualizar" onclick="guardarCambios()">Guardar Cambios</button>
  </div>

  <script>
    function actualizarRegistro(btn) {
      // Implementa lógica para actualizar el registro en la base de datos
      // Puedes obtener los valores de los campos de entrada utilizando DOM
    }

    function guardarCambios() {
      // Implementa lógica para guardar los cambios en la base de datos
      // Puedes enviar los datos al servidor utilizando AJAX
    }
  </script>

</body>

</html>

<?php
// Cerrar la conexión
$conexion->close();
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function actualizarRegistro(btn) {
    var fila = $(btn).closest('tr');
    var punto = fila.find('input[name="punto[]"]').val();
    var normales = fila.find('input[name="normales[]"]').val();
    var rotas = fila.find('input[name="rotas[]"]').val();

    // Aquí deberías enviar estos datos al servidor para actualizar el registro en la base de datos
    // Puedes utilizar AJAX para hacerlo
    // Ejemplo de AJAX con jQuery:
    $.ajax({
      url: 'actualizar_registro.php', // Reemplaza con la URL correcta
      method: 'POST',
      data: {
        punto: punto,
        normales: normales,
        rotas: rotas
      },
      success: function(response) {
        alert('Registro actualizado correctamente');
      },
      error: function(error) {
        console.error('Error al actualizar el registro');
      }
    });
  }

  function guardarCambios() {
    // Aquí deberías recorrer todas las filas de la tabla y enviar los datos al servidor para guardar cambios
    // Puedes utilizar AJAX para hacerlo
    // Ejemplo de AJAX con jQuery:
    var datos = [];
    $('table tbody tr').each(function() {
      var punto = $(this).find('input[name="punto[]"]').val();
      var normales = $(this).find('input[name="normales[]"]').val();
      var rotas = $(this).find('input[name="rotas[]"]').val();
      
      datos.push({
        punto: punto,
        normales: normales,
        rotas: rotas
      });
    });

    $.ajax({
      url: 'guardar_cambios.php', // Reemplaza con la URL correcta
      method: 'POST',
      data: {
        datos: JSON.stringify(datos)
      },
      success: function(response) {
        alert('Cambios guardados correctamente');
      },
      error: function(error) {
        console.error('Error al guardar cambios');
      }
    });
  }
</script>
