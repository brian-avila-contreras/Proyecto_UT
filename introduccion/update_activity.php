<?php
session_start();
require 'db.php'; // Conectar a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Prohibido
    exit();
}

// Obtener el ID del usuario
$userId = $_SESSION['user_id'];

// Actualizar la columna de actividad a 1
$query = "UPDATE usuarios SET actividad = 1 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->close();

// Destruir la sesión para colapsar la sesión del usuario
session_destroy();

// Devolver respuesta JSON
echo json_encode(['status' => 'success']);
?>
