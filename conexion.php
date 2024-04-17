<?php
// Declaración de Variables de conexion

$servername = "localhost"; // Declaración del servidor //
$database = "eagle"; // Declaración de la BD //
$username = "root"; // Declaración del Usuario //
$password = ""; // Declaración de la Contraseña //

// Create connection
$conexion = mysqli_connect($servername, $username, $password, $database);

// Verificamos la conexión a la Base de datos
if (!$conexion) {
    // Si falla la conexion
    die("Conexión fallida: " . mysqli_connect_error());
} else{
    mysqli_set_charset($conexion, "utf8");
}

// conexion exitosa
//echo "Connectado";
//mysqli_close($conexion);
?>