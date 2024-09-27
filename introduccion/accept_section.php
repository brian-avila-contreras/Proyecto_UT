<?php
session_start();
require 'db.php'; // Conectar a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.0 403 Forbidden');
    exit();
}

// Obtener el ID del usuario activo
$userId = $_SESSION['user_id'];

// Recibir la solicitud de sección
$data = json_decode(file_get_contents("php://input"), true);
$sectionId = $data['section_id']; // Cambiado a 'section_id' para que coincida con la estructura de datos esperada

// Insertar la sección aceptada en la base de datos
$query = "INSERT INTO secciones_aceptadas (usuario_id, seccion_id) VALUES (?, ?)";
$stmt = $conn->prepare($query);

// Verificar si la preparación de la declaración fue exitosa
if ($stmt === false) {
    die("Error preparando declaración: " . $conn->error);
}

$stmt->bind_param("ii", $userId, $sectionId);
$stmt->execute();

// Verificar el resultado de la ejecución
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
