<?php
// Conexión a la base de datos
$host = "190.8.176.18";
$usuario = "yacota";
$contrasena = "plantadeproduccion2024";
$base_de_datos = "yacota_wp";

$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibe los datos del POST
$punto = $_POST['punto'];
$normales = $_POST['normales'];
$rotas = $_POST['rotas'];

// Actualiza el registro en la base de datos
$sql = "UPDATE canastillas_existencia SET normales = '$normales', rotas = '$rotas' WHERE punto = '$punto'";

if ($conexion->query($sql) === TRUE) {
    echo "Registro actualizado correctamente";
} else {
    echo "Error al actualizar el registro: " . $conexion->error;
}

$conexion->close();
?>
