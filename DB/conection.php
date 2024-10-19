<?php
// Configuración de la conexión a la base de datos
$host = "localhost";  // Nombre del servidor de la base de datos
$usuario = "root";  // Nombre de usuario de la base de datos
$contrasena = "root";  // Contraseña de la base de datos
$nombre_bd = "BODA_AMG_NLJ";  // Nombre de la base de datos

// Intentar establecer la conexión
try {
    $conexion = new PDO("mysql:host=$host;dbname=$nombre_bd", $usuario, $contrasena);
    // Configurar el modo de error de PDO para que lance excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos";
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
