<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Guardar datos del usuario en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
            $_SESSION['tipo_usuario_id'] = $user['tipo_usuario_id'];

            // Obtener la actividad del usuario
            $actividad = $user['actividad']; // Asegúrate de que este campo exista en la tabla 'usuarios'

            // Redirigir según la actividad
            if ($actividad == 0) {
                header('Location: index.php'); // Redirigir a index.php si la actividad es 0
            } else {
                header('Location: index2.php'); // Redirigir a index2.php si la actividad es 1
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <style>
        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 300px;
            margin: 0 auto 100px;
            padding: 30px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            text-align: center;
        }

        .form .thumbnail {

            width: 250px;
            height: auto;
            margin: 0 auto 30px;
            padding: 50px 30px;
            border-top-left-radius: 100%;
            border-top-right-radius: 100%;
            border-bottom-left-radius: 100%;
            border-bottom-right-radius: 100%;
            box-sizing: border-box;
        }

        .form .thumbnail img {
            display: block;
            width: 100%;
        }

        .form input {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            outline: 0;
            background: #EF3B3A;
            width: 100%;
            border: 0;
            padding: 15px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            color: #FFFFFF;
            font-size: 14px;
            transition: all 0.3 ease;
            cursor: pointer;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #EF3B3A;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
        }

        .container:before,
        .container:after {
            content: "";
            display: block;
            clear: both;
        }

        .container .info {
            margin: 50px auto;
            text-align: center;
        }

        .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .container .info span {
            color: #4d4d4d;
            font-size: 12px;
        }

        .container .info span a {
            color: #000000;
            text-decoration: none;
        }

        .container .info span .fa {
            color: #EF3B3A;
        }

        /* END Form */
        /* Demo Purposes */
        body {
            background: #ccc;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body:before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            display: block;
            background: rgba(255, 255, 255, 0.8);
            width: 100%;
            height: 100%;
        }

        #video {
            z-index: -99;
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
        }

        h2 {
            color: #EF3B3A;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="info">
        </div>
    </div>
    <div class="form">
        <h2><b>Inicio de sesión</b></h2>
        <div class="thumbnail"><img src="../img/logo-ut.png" /></div>
        <form class="login-form" method="post" action="">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar sesión</button>
            <p class="message">¿No estas registrado?<a href="register.php">Crea una cuenta</a></p>
        </form>
    </div>

</body>

</html>