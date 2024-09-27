<?php
session_start();
require 'db.php'; // Conectar a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirigir a la página de inicio de sesión
    exit();
}

// Obtener el ID del usuario activo
$userId = $_SESSION['user_id'];

// Verificar el estado de actividad del usuario
$query = "SELECT actividad FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($actividad);
$stmt->fetch();
$stmt->close();

if ($actividad == 1) {
    echo "<script>alert('Usted ya realizó la lectura y aceptó las secciones. No puede acceder nuevamente a esta página.'); window.location.href = 'login.php';</script>";
    exit();
}

// Array con los títulos y contenidos personalizados para cada sección
$secciones = [
    1 => ['titulo' => 'Introducción', 'contenido' => 'Bienvenido a la primera sección. Aquí aprenderás sobre la importancia del proyecto.'],
    2 => ['titulo' => 'Objetivos', 'contenido' => 'En esta sección discutiremos los objetivos principales de este módulo.'],
    3 => ['titulo' => 'Historia', 'contenido' => 'Aquí tienes un resumen histórico de los principales hitos.'],
    4 => ['titulo' => 'Metodología', 'contenido' => 'Esta sección aborda la metodología utilizada para alcanzar los objetivos.'],
    5 => ['titulo' => 'Resultados Esperados', 'contenido' => 'En esta parte, se muestran los resultados esperados de las acciones implementadas.'],
    6 => ['titulo' => 'Conclusiones', 'contenido' => 'En esta sección analizamos las conclusiones obtenidas a partir del análisis.'],
    7 => ['titulo' => 'Siguientes Pasos', 'contenido' => 'Aquí se plantean los próximos pasos a seguir para el éxito del proyecto.'],
    8 => ['titulo' => 'Resumen Final', 'contenido' => 'Esta es la última sección donde se resumen los puntos más importantes que vimos.']
];

// Verificar si el usuario ya ha aceptado secciones y modificar la estructura de $secciones
$query = "SELECT seccion_id FROM secciones_aceptadas WHERE usuario_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$seccionesAceptadas = [];

while ($row = $result->fetch_assoc()) {
    $seccionesAceptadas[] = $row['seccion_id'];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducción con Progreso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .section {
            display: none;
            margin: 20px 0;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .section.active {
            display: block;
        }
        .progress-bar {
            height: 25px;
            background-color: #e0e0e0;
            border-radius: 15px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .progress-bar div {
            height: 100%;
            background-color: #4caf50;
            width: 0;
            transition: width 0.5s;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .next-btn, .prev-btn, .final-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .next-btn:disabled, .prev-btn:disabled, .final-btn:disabled {
            background-color: #ccc;
        }
        .final-btn {
            display: block;
            background-color: #FF6666;
            font-size: 18px;
            margin-top: 20px;
        }
        .checkbox {
            display: flex;
            align-items: center;
        }
        .accepted {
            color: green; /* Color verde para las secciones aceptadas */
        }
    </style>
</head>
<body>

<!-- Navbar de Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Proyecto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ir a Sección
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach ($secciones as $numero => $seccion): ?>
                            <li><a class="dropdown-item" href="#" onclick="goToSection(<?php echo $numero; ?>)"><?php echo $seccion['titulo']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="progress-bar">
        <div id="progress"></div>
    </div>

    <?php foreach ($secciones as $numero => $seccion): ?>
        <div class="section" id="section<?php echo $numero; ?>">
            <h2><?php echo $seccion['titulo']; ?></h2>
            <p><?php echo $seccion['contenido']; ?></p>
            <div class="checkbox">
                <input type="checkbox" id="accept<?php echo $numero; ?>" class="accept-checkbox" data-section="<?php echo $numero; ?>" <?php echo in_array($numero, $seccionesAceptadas) ? 'checked disabled' : ''; ?>> 
                <label for="accept<?php echo $numero; ?>" class="<?php echo in_array($numero, $seccionesAceptadas) ? 'accepted' : ''; ?>">He leído y acepto esta sección</label>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="navigation">
        <button class="prev-btn" id="prevBtn" disabled>Anterior</button>
        <button class="next-btn" id="nextBtn" disabled>Siguiente</button>
    </div>

    <button class="final-btn" id="finalBtn" disabled>Aceptar Todo</button>
</div>

<!-- Agregar Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let currentSection = 1;
    const totalSections = 8;
    const progress = document.getElementById('progress');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const finalBtn = document.getElementById('finalBtn');
    const checkboxes = document.querySelectorAll('.accept-checkbox');

    function goToSection(section) {
        document.querySelectorAll('.section').forEach((el) => el.classList.remove('active'));
        document.getElementById('section' + section).classList.add('active');
        currentSection = section;

        updateProgressBar();
        updateButtonStates();
    }

    function updateProgressBar() {
        const progressPercentage = (currentSection / totalSections) * 100;
        progress.style.width = progressPercentage + '%';
    }

    function updateButtonStates() {
        prevBtn.disabled = currentSection === 1;
        nextBtn.disabled = !document.getElementById('accept' + currentSection).checked || currentSection === totalSections;
        finalBtn.disabled = !Array.from(checkboxes).every(checkbox => checkbox.checked);
    }

    // Manejar los clics en los checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', (e) => {
            const section = e.target.dataset.section;
            if (e.target.checked) {
                // Marcar la sección como aceptada
                e.target.setAttribute('disabled', true);
                // Añadir lógica para guardar el estado en la base de datos
                saveAcceptedSection(section);
            }
            updateButtonStates();
        });
    });

    // Función para guardar la sección aceptada en la base de datos (placeholder para la lógica de PHP)
    function saveAcceptedSection(section) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_section.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                console.log('Sección guardada:', section);
            }
        };
        xhr.send('section=' + section + '&user_id=<?php echo $userId; ?>');
    }

    nextBtn.addEventListener('click', () => {
        if (currentSection < totalSections) {
            goToSection(currentSection + 1);
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentSection > 1) {
            goToSection(currentSection - 1);
        }
    });

    finalBtn.addEventListener('click', () => {
        // Actualizar la actividad del usuario a 1
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_activity.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                alert('Gracias por leer y aceptar la introducción basica, Debe volver a iniciar sesión.');
                window.location.href = 'login.php'; // Redirigir a logout
            }
        };
        xhr.send('user_id=<?php echo $userId; ?>');
    });

    // Mostrar la primera sección al cargar
    goToSection(currentSection);
</script>
</body>
</html>
