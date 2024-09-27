<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tipo_usuario_id = $_POST['tipo_usuario_id'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, email, password, tipo_usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nombre_usuario, $email, $password, $tipo_usuario_id);

    if ($stmt->execute()) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>

<form method="POST">
    <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <select name="tipo_usuario_id" required>
        <option value="1">Administrador</option>
        <option value="2">Empleado</option>
    </select>
    <button type="submit">Registrarse</button>
</form>
