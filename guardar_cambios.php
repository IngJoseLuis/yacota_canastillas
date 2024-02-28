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
$datos = json_decode($_POST['datos'], true);

foreach ($datos as $registro) {
    $punto = $registro['punto'];
    $normales = $registro['normales'];
    $rotas = $registro['rotas'];

    // Actualiza cada registro en la base de datos
    $sql = "UPDATE canastillas_existencia SET normales = '$normales', rotas = '$rotas' WHERE punto = '$punto'";

    if ($conexion->query($sql) !== TRUE) {
        echo "Error al actualizar el registro: " . $conexion->error;
        $conexion->close();
        exit();
    }
}

echo "Cambios guardados correctamente";

$conexion->close();
?>
