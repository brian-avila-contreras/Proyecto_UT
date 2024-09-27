<?php
session_start();
require 'db.php'; // Asegúrate de incluir tu conexión a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No estás autorizado.']);
    exit();
}

// Obtener el ID del usuario activo
$userId = $_SESSION['user_id'];

// Obtener la solicitud de datos JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si se ha enviado la actividad
if (isset($data['actividad'])) {
    $actividad = $data['actividad'];

    // Actualizar la actividad en la base de datos
    $query = "UPDATE usuarios SET actividad = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $actividad, $userId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Actividad actualizada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la actividad.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
}
$conn->close();
?>
