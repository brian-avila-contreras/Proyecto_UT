<?php
session_start();
require_once '../../db.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: ../../login.php'); // Redirigir a la página de inicio de sesión
  exit();
}

// Obtener el ID del usuario activo
$userId = $_SESSION['user_id'];

// Verificar el estado de actividad del usuario (solo superadministrador puede acceder)
$query = "SELECT tipo_usuario_id FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($tipoUsuario);
$stmt->fetch();
$stmt->close();

$query = "SELECT email FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userId);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

if ($tipoUsuario != 3) {
  echo "<script>alert('Usted no puede acceder a esta página, su rol no es el de Super Administrador.'); window.location.href = '../../login.php';</script>";
  exit();
}

// Determinar el saludo basado en el tipo de usuario
switch ($tipoUsuario) {
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

// Consulta SQL para contar el número total de usuarios y dependencias
$sqlUsuarios = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
$resultUsuarios = $conn->query($sqlUsuarios);
$totalUsuarios = $resultUsuarios ? $resultUsuarios->fetch_assoc()['total_usuarios'] : 0;

$sqlDependencias = "SELECT COUNT(*) AS total_dependencias FROM dependencia";
$resultDependencias = $conn->query($sqlDependencias);
$totalDependencias = $resultDependencias ? $resultDependencias->fetch_assoc()['total_dependencias'] : 0;

// Consulta SQL para obtener los usuarios, dependencias, evaluaciones y estado de actividad
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
$conn->close();
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

</head>

<body class="with-welcome-text">
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
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
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="../../../img/universal-access-solid.svg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <p><?= htmlspecialchars($saludoTipoUsuario) ?></span></p>
                <p class="mb-1 mt-3 fw-semibold"><?= htmlspecialchars($users[0]['nombre_usuario']) ?></p>
                <p class="fw-light text-muted mb-0"><?= htmlspecialchars($email) ?></p>
              </div>
              <a class="dropdown-item" id="logoutBtn"> <i class="fa-solid fa-right-from-bracket"></i>Cerrar Sesión</a>
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
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
              aria-controls="form-elements">
              <i class="menu-icon fa-solid fa-hotel"></i>
              
              <span class="menu-title">Dependencias.</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Nueva dependencia</a></li>
                <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Todas las dependencias</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">

                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div></div>
                          <div id="cont">
                            <p class="statistics-title">Número de Usuarios Creados</p>
                            <h3 class="rate-percentage"><?= htmlspecialchars($totalUsuarios) ?></h3>
                            <p><i class="fa-solid fa-users-viewfinder"></i></p>
                          </div>

                          <div id="cont">
                            <p class="statistics-title">Número de Dependencias Creadas</p>
                            <h3 class="rate-percentage"><?= htmlspecialchars($totalDependencias) ?></h3>
                            <p id="build"><i class="fa-solid fa-building-un"></i><i
                                class="fa-solid fa-building-un"></i><i class="fa-solid fa-building-un"></i></p>
                          </div>
                          <div></div>
                        </div>
                      </div>
                    </div>

                    <div class="row" style="width: 100%;">
                      <div class="col-lg-8 d-flex flex-column" style="width: 100%;">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div id="add">
                                    <div id="add1"><a href=""><i class="mdi mdi-account-plus"></i> Añadir
                                        usuario</a>
                                    </div>
                                    <div id="add1"><a href=""><i class="fa-solid fa-building-user"></i> Añadir
                                        Dependencia</a>
                                    </div>
                                    <div id="add1"><a href=""><i class="fa-solid fa-users-viewfinder"></i> Ver
                                        todos los
                                        usuarios</a></div>
                                    <div id="add1"><a href=""><i class="fa-solid fa-building-circle-arrow-right"></i>
                                        Ver
                                        todas las
                                        Dependencias</a></div>
                                  </div>
                                </div>
                                <div class="table-responsive mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">

                                              <i class="input-helper"></i>
                                            </label>
                                          </div>
                                        </th>
                                        <th>Usuario</th>
                                        <th>Dependencia</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($users as $user): ?>
                                        <tr>
                                          <td>
                                            <div class="form-check form-check-flat mt-0">
                                              <label class="form-check-label">

                                                <i class="input-helper"></i>
                                              </label>
                                            </div>
                                          </td>
                                          <td>
                                            <div class="d-flex">
                                              <img src="../../../img/user.png" alt="">
                                              <div>
                                                <h6><?= htmlspecialchars($user['nombre_usuario']) ?></h6>
                                                <p>Usuario</p>
                                              </div>
                                            </div>
                                          </td>
                                          <td>
                                            <h6><?= htmlspecialchars($user['nombre_dependencia']) ?></h6>
                                            <p>Dependencia</p>
                                          </td>
                                          <td>
                                            <h6>
                                              <?php
                                              // Mostrar el estado basado en la actividad
                                              switch ($user['actividad']) {
                                                case 0:
                                                  echo "En introducción";
                                                  break;
                                                case 1:
                                                  echo "En inducción";
                                                  break;
                                                case 2:
                                                  echo "En evaluación";
                                                  break;
                                                case 3:
                                                  echo "Aprobado";
                                                  break;
                                                default:
                                                  echo "Estado desconocido";
                                              }
                                              ?>
                                            </h6>
                                          </td>
                                          <td>
                                            <div class="btn-group" role="group">
                                              <a href="editar.php?id=<?= $user['id'] ?>" class="btn btn-primary"
                                                id="edit"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
                                              <a href="eliminar.php?id=<?= $user['id'] ?>" class="btn btn-danger"
                                                id="delete"> <i class="fa-solid fa-trash"></i> Eliminar</a>
                                            </div>
                                          </td>
                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
            <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All rights
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
    document.getElementById('logoutBtn').addEventListener('click', function () {
      fetch('../../logout.php', { method: 'POST' })
        .then(response => response.json())
        .then(() => { alert('Cerraste sesión.'); window.location.href = '../../login.php'; });
    });
  </script>
</body>

</html>