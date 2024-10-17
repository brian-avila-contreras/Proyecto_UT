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
        echo '<script type="text/javascript">
        alert("Usuario registrado correctamente.");
        window.location.href = "login.php";
      </script>';
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
           
            width: 200px;
            
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
        select{
            visibility: hidden ;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="info">
        </div>
    </div>
    <div class="form">
        <div class="thumbnail"><img src="../img/logo-ut.png" /></div>
        <form class="login-form" method="post" action="" autocomplete="off" > 
            <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <select name="tipo_usuario_id" style="visibility: invisible;">
                <option value="2">Empleado</option>
            </select>
            <button type="submit">Registrarse</button>
            <p class="message">¿tienes cuenta?<a href="login.php">inicia sessión</a></p>
        </form>
    </div>
</body>

</html>