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

// Array con los títulos y contenidos personalizados para cada sección
$secciones = [
    1 => [
        'titulo' => 'Introducción',
        'contenido' => 'adasdsadsadsadsad',
        'contenido1' => [
            'texto' => 'Aquí tienes un resumen histórico de los principales hitos.',
            'lista' => [
                'Fundación en 1800.',
                'Primera expansión en 1900.',
                'Reconocimientos académicos en 1950.'
            ]
        ],
        'contactos' => [
            [
                'nombre' => 'Pepito Perez',
                'imagen' => 'ruta_imagen_1.jpg',
                'telefono' => '12321321',
                'correo' => 'pepito@example.com'
            ],
            [
                'nombre' => 'Juan Rodriguez',
                'imagen' => 'ruta_imagen_2.jpg',
                'telefono' => '98765432',
                'correo' => 'juan@example.com'
            ],
            // Puedes añadir hasta 5 contactos por sección.
            [
                'nombre' => '', // Dejar vacío para contactos no diligenciados
                'imagen' => '',
                'telefono' => '',
                'correo' => ''
            ],
        ]
    ],
    2 => [
        'titulo' => 'Objetivos',
        'contenido' => 'En esta sección discutiremos los objetivos principales de este módulo.',
        'contactos' => [
            [
                'nombre' => 'Maria Lopez',
                'imagen' => 'ruta_imagen_3.jpg',
                'telefono' => '99999999',
                'correo' => 'maria@example.com'
            ]
            // No se llenaron más contactos en esta sección
        ]
    ],
    // Otras secciones aquí
];


// Verificar el estado de actividad del usuario
$query = "SELECT actividad FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($actividad);
$stmt->fetch();
$stmt->close();

// Si la actividad es 0, redirigir a login.php
if ($actividad === 0) {
    echo "<script>alert('No has realizado la lectura de la introducción básica.'); window.location.href='login.php';</script>";
    exit();
}

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

        .t {
            width: 100%;
            text-align: center;
        }

        .section.active {
            display: block;
        }

        .section.accepted {
            background-color: #e0ffe0;
            /* Color verde claro para las secciones aceptadas */
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
            width: 100%;
            /* Siempre al 100% */
            transition: width 0.5s;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .next-btn,
        .prev-btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .next-btn:disabled,
        .prev-btn:disabled {
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
            color: green;
            /* Color verde para las secciones aceptadas */
        }
    </style>
</head>

<body>

    <!-- Navbar de Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Proyecto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Ir a Sección
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php foreach ($secciones as $numero => $seccion): ?>
                                <li><a class="dropdown-item" href="#"
                                        onclick="goToSection(<?php echo $numero; ?>)"><?php echo $seccion['titulo']; ?></a>
                                </li>
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
    <div class="section <?php echo in_array($numero, $seccionesAceptadas) ? 'accepted' : ''; ?>"
        id="section<?php echo $numero; ?>">
        <div class="t">
            <h2><?php echo $seccion['titulo']; ?></h2>
        </div>

        <p><?php echo $seccion['contenido']; ?></p>

        <?php if (isset($seccion['contenido1']) && is_array($seccion['contenido1'])): ?>
            <p><?php echo $seccion['contenido1']['texto']; ?></p>

            <?php if (isset($seccion['contenido1']['lista']) && is_array($seccion['contenido1']['lista'])): ?>
                <ul>
                    <?php foreach ($seccion['contenido1']['lista'] as $item): ?>
                        <li><?php echo $item; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Verificar y mostrar los contactos diligenciados -->
        <?php if (isset($seccion['contactos']) && is_array($seccion['contactos'])): ?>
            <div class="contactos">
                <h3>Contactos</h3>
                <ul>
                    <?php foreach ($seccion['contactos'] as $contacto): ?>
                        <!-- Mostrar solo si el contacto tiene información completa -->
                        <?php if (!empty($contacto['nombre']) || !empty($contacto['telefono']) || !empty($contacto['correo'])): ?>
                            <li>
                                <?php if (!empty($contacto['imagen'])): ?>
                                    <img src="<?php echo $contacto['imagen']; ?>" alt="Imagen de <?php echo $contacto['nombre']; ?>" width="50">
                                <?php endif; ?>
                                
                                <p><strong>Nombre:</strong> <?php echo $contacto['nombre']; ?></p>
                                <p><strong>Teléfono:</strong> <?php echo $contacto['telefono']; ?></p>
                                <p><strong>Correo:</strong> <a href="mailto:<?php echo $contacto['correo']; ?>"><?php echo $contacto['correo']; ?></a></p>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="checkbox">
            <input type="checkbox" id="accept<?php echo $numero; ?>" class="accept-checkbox"
                data-section="<?php echo $numero; ?>" checked disabled>
            <label for="accept<?php echo $numero; ?>"
                class="<?php echo in_array($numero, $seccionesAceptadas) ? 'accepted' : ''; ?>">
                Ya has leído y aceptado esta sección
            </label>
        </div>
    </div>
<?php endforeach; ?>



        <div class="navigation">
            <button class="prev-btn" id="prevBtn" disabled>Anterior</button>
            <button class="next-btn" id="nextBtn" onclick="nextSection()">Siguiente</button>
        </div>

        <button class="final-btn" id="finalBtn" onclick="location.href='realizar_induccion.php'">Realizar
            Inducción</button>
    </div>

    <!-- Agregar Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let currentSection = 1;
        const totalSections = 8;
        const progress = document.getElementById('progress');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        function goToSection(section) {
            document.querySelectorAll('.section').forEach((el) => el.classList.remove('active'));
            document.getElementById('section' + section).classList.add('active');
            currentSection = section;

            updateButtonStates();
        }

        function nextSection() {
            if (currentSection < totalSections) {
                goToSection(currentSection + 1);
            }
        }

        // Agregar la función para retroceder a la sección anterior
        function prevSection() {
            if (currentSection > 1) {
                goToSection(currentSection - 1);
            }
        }

        function updateButtonStates() {
            prevBtn.disabled = currentSection === 1;
            nextBtn.disabled = currentSection === totalSections;
        }

        // Iniciar mostrando la primera sección
        goToSection(currentSection);

        // Actualizar la barra de progreso a 100%
        progress.style.width = '100%';
        progress.innerText = "¡Has completado la introducción!";

        // Asignar la función de retroceso al botón de "Anterior"
        prevBtn.addEventListener('click', prevSection);

        // Redirigir a 'realizar_induccion.php' al hacer clic en "Realizar Inducción"
        document.getElementById('finalBtn').addEventListener('click', () => {
            const checkboxes = document.querySelectorAll('.accept-checkbox');
            let allAccepted = true;
            checkboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    allAccepted = false;
                }
            });

            if (allAccepted) {
                window.location.href = 'realizar_induccion.php'; // Redirigir si todas las secciones están aceptadas
            } else {
                alert('Debes aceptar todas las secciones antes de continuar.');
            }
        });
    </script>


</body>

</html>