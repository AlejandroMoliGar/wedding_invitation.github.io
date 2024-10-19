<?php
// Incluir el archivo de conexión
require_once '../DB/conection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asistencia = $_POST['asistencia'];
    $invitados = $_POST['invitados'];
    $mensaje = $_POST['mensaje'];
    
    // Validación básica
    if (empty($nombre) || empty($email) || empty($asistencia)) {
        die("Por favor, complete todos los campos obligatorios.");
    }
    
    // Preparar y ejecutar la consulta SQL
    $sql = "INSERT INTO confirmaciones (nombre, email, asistencia, invitados, mensaje) VALUES (:nombre, :email, :asistencia, :invitados, :mensaje)";
    
    try {
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':asistencia' => $asistencia,
            ':invitados' => $invitados,
            ':mensaje' => $mensaje
        ]);
        
        echo "¡Gracias por confirmar tu asistencia!";
    } catch (PDOException $e) {
        echo "Lo sentimos, hubo un problema al guardar tu confirmación: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}

// Cerrar la conexión
$conexion = null;
?>

