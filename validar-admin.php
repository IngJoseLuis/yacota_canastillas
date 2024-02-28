<?php
session_start();

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

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $clave = $_POST["clave"];
    $recaptcha_response = $_POST["g-recaptcha-response"];

    // Verificar reCAPTCHA
    $recaptcha_secret_key = "6LcQn3YpAAAAAP1_levyDbdZ6dJ6zD-TsAveUVES";
    $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
    $recaptcha_data = [
        'secret' => $recaptcha_secret_key,
        'response' => $recaptcha_response
    ];
    $recaptcha_options = [
        'http' => [
            'method' => 'POST',
            'content' => http_build_query($recaptcha_data)
        ]
    ];
    $recaptcha_context = stream_context_create($recaptcha_options);
    $recaptcha_result = json_decode(file_get_contents($recaptcha_url, false, $recaptcha_context), true);

    // Verificar si reCAPTCHA es válido
    if ($recaptcha_result && $recaptcha_result['success']) {
        // Consulta SQL para verificar el login
        $consulta = "SELECT * FROM canastillas_admin WHERE nombre_usuario = '$nombre_usuario' AND clave = '$clave'";
        $resultado = $conexion->query($consulta);

        // Verificar si se encontró un usuario
        if ($resultado->num_rows > 0) {
            // Iniciar sesión
            $_SESSION["nombre_usuario"] = $nombre_usuario;

            // Redirigir a la página de administrador
            header("Location: admin-canastillas.php");
            exit();
        } else {
          header("Location: error-admin.html");
        }
    } else {
      header("Location: error-admin.html");
    }
}

// Cerrar la conexión
$conexion->close();
?>
