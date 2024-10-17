<?php
$host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
$user = 'root'; // Cambia esto por tu nombre de usuario de la base de datos
$password = ''; // Cambia esto por tu contraseña de la base de datos
$database = 'ut'; // Nombre de la base de datos que creaste

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
