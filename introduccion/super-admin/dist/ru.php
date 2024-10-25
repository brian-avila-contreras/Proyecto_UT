<?php
session_start();
require '../../db.php'; // Conectar a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Gracias por leer y aceptar la introducción básica. Debe volver a iniciar sesión.');
    window.location.href = 'login.php'; // Redirige a login.php
</script>";
    exit();
}

// Obtener el ID del usuario activo
$userId = $_SESSION['user_id'];

$query = "SELECT tipo_usuario_id FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($tp);
$stmt->fetch();
$stmt->close();
$query = "SELECT email FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userId);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if (($tp < 3) or ($tp > 3)) {
    echo "<script>alert('Usted No puede acceder a esta pagina, su rol no es el de  super administrador'); window.location.href = 'login.php';</script>";
    exit();
}
switch ($tp) {
    case 1:
        $saludoTipoUsuario = "Administrador";
        break;
    case 2:
        $saludoTipoUsuario = "Empleado";
        break;
    case 3:
        $saludoTipoUsuario = "Super Administrador";
        break;
    case 4:
        $saludoTipoUsuario = "Director de Dependencia";
        break;
    default:
        $saludoTipoUsuario = "Usuario";
        break;
}
$sql = "SELECT u.id, u.nombre_usuario, 
               IFNULL(d.nombre_dependencia, 'Sin dependencia') AS nombre_dependencia, 
               IFNULL(e.titulo, 'Sin evaluación') AS titulo_evaluacion, 
               u.actividad
        FROM usuarios u
        LEFT JOIN dependencia d ON u.id_dependencia = d.id
        LEFT JOIN evaluaciones e ON e.dependencia_id = d.id"; // Asegúrate de que esta relación sea correcta

// Ejecutar la consulta
$result = $conn->query($sql);

// Almacenar los usuarios en un array
$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo "No se encontraron usuarios.";
}

// Consulta para obtener todas las dependencias
$sqlDependencias = "SELECT id, nombre_dependencia FROM dependencia";
$resultDependencias = $conn->query($sqlDependencias);

$dependencias = [];
if ($resultDependencias && $resultDependencias->num_rows > 0) {
    while ($row = $resultDependencias->fetch_assoc()) {
        $dependencias[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_user'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $tipo_usuario_id = $_POST['tipo_usuario_id'];

    $stmt = $conn->prepare("INSERT INTO usuarios (id,nombre_usuario, email, password, tipo_usuario_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isssi", $id, $nombre_usuario, $email, $password, $tipo_usuario_id);

    if ($stmt->execute()) {
        echo '<script type="text/javascript">
        alert("Usuario registrado correctamente.");
        window.location.href = "index.php";
      </script>';
    } else {
        echo "Error al registrar el usuario.";
    }
}
date_default_timezone_set('America/Bogota');

// Obtener la hora actual
$horaActual = date('g:i A'); // Formato 12 horas con AM/PM

// Determinar el saludo basado en la hora
if (date('H') < 12) {
    $saludo = "Buenos días";
} elseif (date('H') < 18) {
    $saludo = "Buenas tardes";
} else {
    $saludo = "Buenas noches";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <script src="https://kit.fontawesome.com/472ee62007.js" crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="../../../css/estilos_sadmin.css">
    <style>
        .form {
            position: relative;
            z-index: 1;
            background: #f0f0f0;
            /* Un tono de blanco más oscuro */
            max-width: 600px;
            /* Ampliar el ancho máximo para un diseño horizontal */
            margin: 0 auto 100px;
            padding: 30px;
            border-radius: 3px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            /* Sombra suave */
            display: flex;
            /* Usar flexbox para el diseño horizontal */
            flex-direction: row;
            /* Dirección horizontal */
            justify-content: space-between;
            /* Espacio entre elementos */
            align-items: center;
            /* Alinear elementos verticalmente */
        }

        .form .thumbnail {
            width: 100px;
            /* Reducir el tamaño de la imagen */
            margin: 0 30px 0 0;
            /* Espaciado a la derecha */
            padding: 0;
            /* Sin padding para la imagen */
            border-radius: 50%;
            /* Hacer la imagen circular */
            box-sizing: border-box;
        }

        .form .thumbnail img {
            display: block;
            width: 100%;

            /* Asegurar que la imagen también sea circular */
        }

        .form input {
            outline: 0;
            background: #f2f2f2;
            width: calc(100% - 20px);
            /* Asegurarse de que el ancho no sobrepase el contenedor */
            border: 0;
            margin: 0 0 15px;
            padding: 10px;
            border-radius: 3px;
            /* Simplificar la declaración de border-radius */
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 14px;
        }

        .form select {
            outline: 0;
            background: #f2f2f2;
            width: calc(100% - 20px);
            /* Asegurarse de que el ancho no sobrepase el contenedor */
            border: 0;
            margin: 0 0 15px;
            padding: 10px;
            border-radius: 3px;
            /* Simplificar la declaración de border-radius */
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-size: 14px;
            margin-left: 2%;
        }

        .form button {
            outline: 0;
            background: #EF3B3A;
            width: 100%;
            border: 0;
            padding: 15px;
            border-radius: 3px;
            /* Simplificar la declaración de border-radius */
            color: #FFFFFF;
            font-size: 14px;
            transition: all 0.3s ease;
            /* Añadir la unidad de tiempo 's' */
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
            max-width: 600px;
            /* Ampliar el ancho máximo para el contenedor */
            margin: 0 auto;
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
    </style>

</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="index.html">
                        <img src="../../../img/logo-ut.png" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="../../../img/ut.png" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">
                            <?= htmlspecialchars($saludo) ?>, <span><?= htmlspecialchars($saludoTipoUsuario) ?></span>
                            <?php if (!empty($users)) { ?>
                                <span><?= htmlspecialchars($users[0]['nombre_usuario']) ?></span>
                            <?php } ?>
                            <span><?= htmlspecialchars($horaActual) ?></span> <!-- Muestra la hora actual -->
                        </h1>

                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link1" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../../../img/universal-access-solid.svg"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <p><?= htmlspecialchars($saludoTipoUsuario) ?></span></p>
                                <p class="mb-1 mt-3 fw-semibold"><?= htmlspecialchars($users[0]['nombre_usuario']) ?>
                                </p>
                                <p class="fw-light text-muted mb-0"><?= htmlspecialchars($email) ?></p>
                            </div>
                            <a class="dropdown-item" id="logoutBtn"> <i
                                    class="fa-solid fa-right-from-bracket"></i>Cerrar Sesión</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: #f8f9fa;">
                <ul class="nav">
                    <!-- Sección Dependencias -->
                    <li class="nav-item" id="dependencias">
                        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements" style="color: #333;">
                            <i class="menu-icon fa-solid fa-hotel" style="color: #333;"></i>
                            <span class="menu-title" style="color: #333;">Dependencias</span>
                            <i class="menu-arrow" style="color: #333;"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html"
                                        style="color: #333;">Ver
                                        las dependencia</a></li>
                                <li class="nav-item"><a class="nav-link" href="" style="color: #333;">Registrar
                                        Dependencias</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Sección User Pages -->
                    <li class="nav-item" id="user-pages">
                        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth" style="color: #333;">
                            <i class="menu-icon mdi mdi-account-circle-outline" style="color: #333;"></i>
                            <span class="menu-title" style="color: #333;">Usuarios</span>
                            <i class="menu-arrow" style="color: #333;"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="pages/samples/blank-page.html"
                                        style="color: #333;">Ver
                                        los usuarios</a></li>
                                <li class="nav-item"><a class="nav-link" href="pages/samples/login.html"
                                        style="color: #333;">Registrar
                                        Usuarios</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!-- Sección Tablas de Información -->

                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="home-tab">
                                <div class="container">
                                    <div class="info">
                                    </div>
                                </div>
                                <div class="form">
                                    <div class="thumbnail"><img src="../../../img/ut.png" /></div>
                                    <form class="login-form" method="post" action="" autocomplete="off">
                                        <input type="number" name="id_user" placeholder="N° Identificación" required>
                                        <input type="text" name="nombre_usuario" placeholder="Nombre de usuario"
                                            required>
                                        <input type="email" name="email" placeholder="Correo electrónico" required>
                                        <input type="password" name="password" placeholder="Contraseña" required>
                                        <select name="tipo_usuario_id" class="form-select"
                                            aria-label="Disabled select example">
                                            <option value="" disabled selected> Seleccione Tipo de Usuario</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Empleado</option>
                                            <option value="3">Superadmin</option>
                                        </select>
                                        <select name="dependencia" id="dependencia" class="form-select"
                                            aria-label="Disabled select example">
                                            <option value="" disabled selected>Seleccione una Dependencia</option>
                                            <?php foreach ($dependencias as $dependencia) { ?>
                                                <option value="<?= htmlspecialchars($dependencia['id']) ?>">
                                                    <?= htmlspecialchars($dependencia['nombre_dependencia']) ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                        <button type="submit">Registrar Usuario</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                            BootstrapDash.</span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All
                            rights
                            reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
    <script>
        // Esperar a que el DOM esté cargado
        document.addEventListener("DOMContentLoaded", function () {
            // Desactivar la activación automática de cualquier submenú
            document.querySelectorAll('.collapse').forEach(collapse => {
                collapse.classList.remove('show'); // Asegurarse de que los submenús estén cerrados inicialmente
            });

            // Aplicar estilos solo a los iconos cuando el enlace está activo por selección del usuario
            document.querySelectorAll('.nav-link2').forEach(link => {
                link.addEventListener('click', function () {
                    // Restablecer el color de todos los enlaces y iconos
                    document.querySelectorAll('.nav-link2').forEach(l => {
                        l.style.color = '#333';
                        l.querySelectorAll('i').forEach(icon => {
                            icon.style.color = '#333';
                        });
                    });

                    // Cambiar el color de los iconos del enlace activo
                    this.style.color = '#ff6666'; // Solo cambia el color del texto del enlace
                    this.querySelectorAll('i').forEach(icon => {
                        icon.style.color = '#ff6666';
                    });
                });
            });
        });
    </script>

    <script>
        // Script para el cierre de sesión
        document.getElementById('logoutBtn').addEventListener('click', function () {
            fetch('../../logout.php', { method: 'POST' })
                .then(response => response.json())
                .then(() => {
                    alert('Cerraste sesión.');
                    window.location.href = '../../login.php';
                });
        });
    </script>


</body>

</html>