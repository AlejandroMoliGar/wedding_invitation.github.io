<?php
// Incluir el archivo de conexión
require_once '../DB/conx.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING));
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $asistencia = filter_input(INPUT_POST, 'asistencia', FILTER_SANITIZE_STRING);
    $invitados = filter_input(INPUT_POST, 'invitados', FILTER_SANITIZE_NUMBER_INT);
    $mensaje = trim(filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING));
    
    if (empty($nombre) || empty($email) || empty($asistencia) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, complete todos los campos obligatorios correctamente.']);
        exit;
    }
    
    $sql = "INSERT INTO confirmaciones (nombre, email, asistencia, invitados, mensaje) VALUES (:nombre, :email, :asistencia, :invitados, :mensaje)";
    
    try {
        if (!isset($conexion) || !($conexion instanceof PDO)) {
            throw new Exception("Error de conexión a la base de datos");
        }

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':asistencia' => $asistencia,
            ':invitados' => $invitados,
            ':mensaje' => $mensaje
        ]);
        
        echo json_encode(['success' => true, 'message' => '¡Gracias por confirmar tu asistencia!']);
    } catch (Exception $e) {
        error_log("Error en la base de datos: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Lo sentimos, hubo un problema al guardar tu confirmación. Por favor, inténtalo de nuevo más tarde.']);
    } finally {
        $conexion = null;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
}
?>
