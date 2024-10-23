<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';  // Nombre del servidor de la base de datos
$db   = 'confirmaciones_boda';  // Nombre de la base de datos
$user = 'root';  // Nombre de usuario de la base de datos
$pass = '';  // Contraseña de la base de datos
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Intentar establecer la conexión
try {
    $conexion = new PDO($dsn, $user, $pass, $options);
    echo "Conexión exitosa a la base de datos";
} catch (\PDOException $e) {
    die("Error de conexión: " . $e->getMessage() . "\n");
    die("DSN utilizado: " . $dsn . "\n");
}
?>
