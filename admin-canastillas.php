<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["nombre_usuario"])) {
  header("Location: administrador.php");
  exit();
}

$usuario = $_SESSION["nombre_usuario"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido <?php echo $usuario; ?></title>
  <link rel="stylesheet" href="style-admin.css">
</head>

<body>

  <header>
    <img src="./imagenes/logo.png" class="logo" alt="Logo">

    <!-- Icono y enlace para cerrar sesión -->
    <a href="cerrar_sesion.php" id="cerrar-sesion">Cerrar Sesión
      <img class="logout" src="./imagenes/logout.jpg" alt="Cerrar Sesión">

    </a>
  </header>

  <div class="contenido">
    <h1>Bienvenida <?php echo $usuario; ?></h1>
    <p>Justos podemos mantener el orden de las canastillas</p>

    <div class="cards">
      <!-- Card 1: Inventario -->
      <div class="card">
        <h2>Inventario</h2>
        <p>Valores reales en existencia</p>
        <img src="https://cdn-icons-png.flaticon.com/512/7060/7060633.png" alt="">
        <a class="boton_card" href="inventario.php">Ir a Inventario</a>
      </div>

      <!-- Card 2: Registros -->
      <div class="card">
        <h2>Registros</h2>
        <p>Ver los registros almacenados</p>
        <img src="https://cdn-icons-png.flaticon.com/512/554/554795.png" alt="">
        <a class="boton_card" href="registros.php">Ir a Registros</a>
      </div>

        <!-- Card 3: Control -->
        <div class="card">
        <h2>Control</h2>
        <p>Ver las diferencias</p>
        <img src="https://cdn-icons-png.flaticon.com/512/5352/5352155.png" alt="">
        <a class="boton_card" href="control.php">Ir a Control</a>
      </div>
    </div>
  </div>

  <!-- Agrega tu script JavaScript aquí si es necesario -->

</body>

</html>