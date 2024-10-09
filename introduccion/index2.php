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
        'titulo' => 'Rectoría',
        'contenido' => 'Representante Legal y la primera autoridad ejecutiva de la Universidad, responsable de las decisiones académicas, administrativas y financieras (artículo 25 del Estatuto General).
La Rectoría es una dependencia de la Universidad del Tolima a cargo del rector, quien es el representante legal y la primera autoridad ejecutiva de la institución; en tal carácter y en el ámbito de su competencia, es responsable de la gestión académica y administrativa, es quien debe adoptar las decisiones necesarias para el desarrollo y buen funcionamiento de la Institución.',
        'contenido1' => [
            'texto' => 'Funciones del Rector.',
            'lista' => [
                'Cumplir y hacer cumplir las normas constitucionales, legales estatutarias y reglamentarias vigentes, y las decisiones de los Consejos Superior y Académico.',
                'Desarrollar y dirigir la proyección institucional al medio exterior y orientar los planes de desarrollo de la Universidad.',
                'Proponer, al Consejo Superior, para su aprobación, el Plan de Desarrollo de la Universidad, elaborado por la Oficina de Desarrollo Institucional, una vez que haya sido revisado y recomendado por el Consejo Académico.',
                'Presentar, al Consejo Superior, para su aprobación, el Presupuesto anual de la Universidad, elaborado por la Oficina de Desarrollo Institucional, una vez que haya sido revisado y recomendado por el Consejo Académico, así como las modificaciones que en su implementación se hagan necesarias.',
                'Aprobar los manuales de funciones y requisitos, y de procedimientos administrativos.',
                'Evaluar y controlar el funcionamiento general de la Universidad, informar de ello al Consejo Superior, y disponer o proponer a las instancias correspondientes, las acciones a que haya lugar.',
                'Responder por la calidad del control interno de la Universidad.',
                'Asegurar el desarrollo de los procesos necesarios para la acreditación de la Universidad, en armonía con lo dispuesto en el Estatuto General de la Universidad, y en la ley.'
            ]
        ],
        'contactos' => [

        ],
        'cont1' => 'Correo:<a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#drafts?compose=GTvVlcSHvbPQljgxjhKqjghZqGTjSgXwQmlJmHhglrqjKsWdktTbpGsxvFrvqBPnVlZccqJQrchZB">rectoria@ut.edu.co</a>',
        'cont2' => 'Secretaria:  9111 - 9112',
        'cont3' => 'Asesora: 9192 ',
        'con' => '<h5><b>Contactos</b></h5>'


    ],
    2 => [
        'titulo' => 'VICERRECTORÍA DE DOCENCIA',
        'contenido' => 'La Vicerrectoría de Docencia es la unidad encargada de orientar, direccionar, coordinar, controlar y evaluar los procesos académicos institucionales, fomentando la calidad, promoviendo y generando espacios para la innovación y el uso de herramientas TICs. Para ello, formula las políticas y lineamientos generales respecto a la función académica, en el marco del Proyecto Educativo Institucional-PEI.',
        'contenido1' => [
            'texto' => '<b>FUNCIONES DEL VICERRECTOR DE DOCENCIA</b>',
            'lista' => [
                'Promover y coordinar el desarrollo académico e investigativo de la Universidad',
                'Velar por el cumplimiento de las normas y políticas académicas de la universidad',
                'Coordinar en asocio con la Oficina de Planeación, los planes y programas de desarrollo académico e investigativo para ser presentados al Consejo Académico',
                'Promover, de manera permanente, la formación y capacitación del profesorado',
                'Promover, de manera permanente, la formación y capacitación del profesorado',

            ]
        ],
        'contenido2' => '<p>La actividad académica es la razón de ser fundamental de la Universidad, concierne a la <b> Vicerrectoría de Docencia </b> promover y coordinar el desarrollo académico de la Institución.
La Vicerrectoría de Docencia comprende las facultades, institutos, escuelas, departamentos, programas académicos, centros académicos, observatorios y direcciones académico-administrativas.</p>',
        'ttitulo2' => ' <h5><b>ESTRUCTURA INTERNA</b></h5>',
        'contenido3' => '<p>La estructura interna de la Vicerrectoría de Docencia está compuesta por las siguientes unidades: </p>1. Secretaría Académica General.</p> <p>2. Centros Académicos y Observatorios.</p><p>3. Dirección de Admisiones, Registro y Control Académico.</p><p>4. Dirección de Aseguramiento de la Calidad.</p><p>5. Dirección de Gestión de Bibliotecas.
</p><p>6. Facultades.</p> <p>7. Instituto de Educación a Distancia.</p><br><h5>Comités</h5><br><ul><li>Comité de desarrollo a la docencia</li> <li>Comité de admisiones</li> <li>Comité interno de asignación y reconocimiento de puntaje</li> <li>Comité central de evaluación y escalafón docente</li> <li>Comité de directores de departamento</li> <li>Comité de directores de unidad académica</li> <li>Comité central de proyección social</li> <li>Comité central de currículo</li> <li>Comité de sabático</li> <li>Comité de autoevaluación</li> <li>Comité de directores de programa</li> </ul> ',
        'contactos' => [
            [
                'nombre' => 'DRA. Martha Lucia Nuñez.',
                'cargo' => 'Vicerrectora de Docencia',
                'imagen' => '../img/Martha_Lucia_Nuñez.jpg',
                'telefono' => '<i class="fa-solid fa-phone"></i> TEL: 2771212 Ext 9127 ',
                'correo' => '<i class="fa-solid fa-envelope"></i> Correo: <a href="mailto:vac@ut.edu.co" > vac@ut.edu.co</a>',
            ],
            [
                'nombre' => 'DRA. GLORIA YOLANDA OSPINA PACHECO',
                'cargo' => 'Secretaria  Académica',
                'imagen' => '../img/YOLANDA_OSPINA.jfif',
                'telefono' => '<i class="fa-solid fa-phone"></i> TEL: 2771212 Ext 9127',
                'correo' => '<i class="fa-solid fa-envelope"></i> Correo: <a href="mailto:vac@ut.edu.co" > vac@ut.edu.co</a> / <a href="mailto:gloyosp@ut.edu.co" > gloyosp@ut.edu.co</a>',
            ],


        ],
        'cont1' => '',
        'cont2' => '',
        'cont3' => '',
        'con' => '<h5><b>Contactos</b></h5>'


    ],
    3 => [
        'titulo' => 'Vicerrectoria academica y financiera',
        'contenido' => '',
        'contenido1' => [
            'texto' => '<b></b>',
            'lista' => [
                'Cumplir, adelantar y ejecutar las políticas, programas, planes y objetivos que sean establecidos por el Consejo superior y por el Rector de la Universidad.',
                'Verificar y controlar el manejo de los recursos financieros y materiales de la Institución, que permita su racionalización y optimización, para garantizar el normal funcionamiento de esta.',
                'Administrar las políticas de desarrollo humano, aplicables al personal administrativo, controlar su regulación y prestar la asesoría requerida por el Rector para su manejo, capacitación y eficiencia.',
                'Regular, a través de la División de Relaciones Laborales y Prestacionales, el procesamiento de nóminas y registro y control de personal, de los servidores de la Institución.',
                'Asesorar y presentar propuestas al rector, sobre planes y medidas que en materia administrativa  y financiera, se deban adelantar por Universidad, con el fin de facilitar el cumplimiento de objetivos y naturaleza de la misma.',
                'Elaborar, con base en evaluación de necesidades de cada dependencia, el anteproyecto de presupuesto para el estudio y análisis del Rector.',
                'Coordinar, dirigir y controlar las dependencias a su cargo, para garantizar el cumplimiento de los planes, programas y objetivos a cargo de la vicerrectoría.',
                'Presentar al Rector, en periodo oportuno para su estudio, evaluación y análisis, el proyecto del acuerdo mensual del gasto.',
                'Asistir al Consejo Académico y demás organismos que por la naturaleza de sus funciones requieran de su presencia y participación.',
                'Acompañar al Rector a las sesiones del Consejo Superior, para brindarle el apoyo y asesoría requeridos y resolver las inquietudes que sobre su dependencia se discutan en dicho organismo.',
                'Presidir, en ausencia del Rector, el Comité de Coordinación Administrativa e interesarse por las oportunas convocatorias del mismo.',
                'Presentar los balances financieros semestrales al Rector, y el informe sobre el funcionamiento de su dependencia.',
                'Coordinar en la Vicerrectoría Académica, el adecuado desarrollo de los servicios relacionados con prácticas estudiantiles, servicio de cafetería y residencia, medios audiovisuales, provisión de laboratorios y demás requerimientos del objeto educativo.',
                'Observar el oportuno y eficaz manejo de la contabilidad y el trámite de las cuentas a cargo del tesorero de la universidad.',
                'Supervisar el manejo de los fondos y cajas menores, e indicar su correctivo. Semestralmente, la Vicerrectoría presentará al Rector, un informe sobre estas dependencias.',
                'Supervisar el proceso de matrícula administrativa, y aplicar las medidas que estime adecuadas para su eficiente recaudo.',
                'Atender el pago de las nóminas institucionales y los reconocimientos prestacionales que tenga pendiente con sus servidores de la Universidad.',
                'Coordinar el adecuado desarrollo de las compras y suministros que requieran las diferentes dependencias para su normal funcionamiento.',
                'Ejercer las demás funciones que le asigne la ley y que sean inherentes a su cargo.',
                'Presupuestos y Finanzas',
            ]
        ],
        'contenido2' => '<p></p>',
        'ttitulo2' => ' <h5><b></b></h5>',
        'contenido3' => '',
        'contactos' => [
            [
                'nombre' => 'Mario Ricardo López',
                'cargo' => 'Vicerrector Administrativo',
                'imagen' => '../img/MARIO_RICARDO_LOPEZ.jpg',
                'telefono' => '<i class="fa-solid fa-phone"></i> TEL: 2771212 Ext 9152-9172 ',
                'correo' => '<i class="fa-solid fa-envelope"></i> Correo: <a href="mailto:vad@ut.edu.co" >vad@ut.edu.co</a>',
            ],


        ],
        'cont1' => '',
        'cont2' => '',
        'cont3' => '',
        'con' => '<h5><b>Contactos</b></h5>'


    ],
    4 => [
        'titulo' => 'VIcerrectoría Desarrollo Humano',
        'contenido' => 'Propiciar lo medios necesarios, para el cumplimiento de las políticas institucionales en el campo del desarrollo humano y el bienestar de la comunidad universitaria, que conlleven a la formación integral del futuro profesional y demás miembros de la institución en mejora de su calidad de vida y del medio universitario.',
        'contenido1' => [
            'texto' => '<b>Objetivos específicos</b>',
            'lista' => [
                'Promocionar dentro de la comunidad universitaria nuestros valores culturales: artísticos, literarios, modos de vida, derechos fundamentales de ser humano, los sistemas de valores, las tradiciones, las creencias y los imaginarios colectivos.',
                'Ofrecer adecuados programas de salud, mediante programas preventivos y correctivos, con el fin de mejorar la salud física, psíquica, espiritual, social y ocupacional, de todos los miembros de la comunidad universitaria, como también la prevención y atención de situaciones de emergencia y alto riesgo.',
                'Ofrecer programas deportivos y de recreación, con fines formativos como individuos miembros de una sociedad, procurando una educación en valores como integración, solidaridad, ética, organización, respeto, salud y cultura preservacionista y ambiental',
                'Propiciar programas de apoyo socioeconómicos para aquellos miembros de la comunidad universitaria que se encuentran en crisis y vean afectada su permanencia dentro de la misma.',
                'Apoyar y dar espacios que propicien el encuentro de los miembros de la comunidad universitaria y la utilización de su tiempo libre, fomentando la integración entre todos los miembros de la comunidad, el respeto por opiniones, críticas, inquietudes y pensamientos
Propender por la vigencia del ethos universitario que se centra en la unidad en la diversidad.',
                'Incentivar a los miembros de la comunidad universitaria a través de programas que exalten sus capacidades, logros, servicios, crear colectivos académicos e intelectuales.',
                'Crear el ambiente ideal entre los servicios de bienestar, la academia y la administración institucional, con sentido de pertenencia universitaria y de comunidad.',
                'Divulgar tanto internamente, como hacia el exterior de la Universidad, los programas y servicios de bienestar y cultura, creando conciencia de un buen uso de ellos y vinculándolos dentro de una amplia noción del bienestar, así como orientar a los miembros de la comunidad y de fuera de ella, en los diferentes temas de la vida universitaria y su medio.',
                'Impulsar y apoyar las investigaciones sobre bienestar y cultura, que propendan en el mejoramiento de su gestión y de la vida universitaria, así como los sistemas de seguimiento y evaluación de los mismos.',
                'Fortalecer, mejorar y aumentar la planta física requerida para el desarrollo de las políticas culturales y de bienestar, así como la dotación de las mismas.',
            ]
        ],
        'contenido2' => '<p></p>',
        'ttitulo2' => ' <h5><b></b></h5>',
        'contenido3' => '',
        'contactos' => [
            [
                'nombre' => 'Diego Alberto Polo Paredes',
                'cargo' => 'Vicerrector de Desarrollo Humano',
                'imagen' => '',
                'telefono' => '<i class="fa-solid fa-phone"></i> TEL: 2771212 Ext 9142 ',
                'correo' => '<i class="fa-solid fa-envelope"></i> Correo: <a href="mailto:vdh@ut.edu.co" >vdh@ut.edu.co</a>',
            ],


        ],
        'cont1' => '',
        'cont2' => '',
        'cont3' => '',
        'con' => '<h5><b>Contactos</b></h5>'


    ],
    5 => [
        'titulo' => 'Vicerrectoría de Investigación - Creación, Innovación, Extensión y Proyección Social',
        'contenido' => '<b><i class="fa-solid fa-building-columns"></i></b><br><b><h5>Investigaciones</h5></b><br><p>La Vicerrectoría de Investigación-Creación, Innovación, Extensión y Proyección Social se encarga de fomentar el desarrollo de la investigación-creación, innovación, como insumo fundamental de difusión del conocimiento, saberes disciplinarios y profesionales, soportados en grupos de investigación y en el conocimiento que circula en los ámbitos de la sociedad y las comunidades académicas; la Extensión, que promueve la interacción e integración de la universidad con su entorno y la apropiación social del conocimiento y la Proyección Social que busca impactar diferentes sectores de la región y la comunidad.</p>',
        'contenido1' => [
            'texto' => '<b><i class="fa-solid fa-book-open"></i></i></b><br><b><h5>Nuestros servicios</h5></b><p>Servicios Investigaciones</p><ul><li><a href="#">Proyectos</a></li><li><a href="#">Semilleros</a></li><li><a href="#">Grupos de investigación</a></li><li><a href="#">Convocatorias</a></li><li><a href="#">Sello editorial</a></li><li><a href="#">Directorio de investigaciones</a></li> ',
            'lista' => [



            ]
        ],
        'contenido2' => '<p></p>',
        'ttitulo2' => ' <h5><b></b></h5>',
        'contenido3' => '',
        'contactos' => [
        ],
        'cont3' => 'Video Institucional',
        'video' => '../img/ut_video.mp4',
        'con' => '',
        'cont1' => '',
        'cont2' => '',


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
        <div class="progress-bar progress-bar-striped bg-danger">
            <div id="progress"></div>
        </div>

        <?php foreach ($secciones as $numero => $seccion): ?>
            <div class="section" id="section<?php echo $numero; ?>">
                <!-- Título de la sección -->
                <h2><?php echo $seccion['titulo']; ?></h2>

                <!-- Contenido principal de la sección -->
                <p><?php echo $seccion['contenido']; ?></p>

                <!-- Mostrar contenido adicional si existe -->
                <?php if (isset($seccion['contenido1']) && is_array($seccion['contenido1'])): ?>
                    <p><?php echo $seccion['contenido1']['texto']; ?></p>

                    <!-- Mostrar lista si existe dentro de contenido1 -->
                    <?php if (isset($seccion['contenido1']['lista']) && is_array($seccion['contenido1']['lista'])): ?>
                        <ul>
                            <?php foreach ($seccion['contenido1']['lista'] as $item): ?>
                                <li><?php echo $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (isset($seccion['contenido2'])): ?>
                    <p><?php echo $seccion['contenido2']; ?></p>
                <?php endif; ?>
                <?php if (isset($seccion['ttitulo2'])): ?>
                    <p><?php echo $seccion['ttitulo2']; ?></p>
                    <?php if (isset($seccion['contenido3'])): ?>
                        <p><?php echo $seccion['contenido3']; ?></p>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Mostrar contactos si existen -->
                <?php if (isset($seccion['contactos']) && is_array($seccion['contactos'])): ?>
                    <div class="contactos">
                        <?php if (isset($seccion['con'])): ?>
                            <p><?php echo $seccion['con']; ?></p>
                        <?php endif; ?>
                        <ul style="list-style-type: style none;">
                            <?php foreach ($seccion['contactos'] as $contacto): ?>
                                <?php if (!empty($contacto['nombre']) || !empty($contacto['telefono']) || !empty($contacto['correo'])): ?>
                                    <li style="list-style:none;">
                                        <!-- Mostrar imagen si existe -->
                                        <?php if (!empty($contacto['imagen'])): ?>
                                            <img src="<?php echo $contacto['imagen']; ?>" alt="Imagen de <?php echo $contacto['nombre']; ?>"
                                                width="100" height="100">
                                        <?php endif; ?>

                                        <!-- Mostrar los datos del contacto -->
                                        <br><i><b><?php echo $contacto['nombre']; ?></b></i><br>
                                        <sub> <?php echo $contacto['cargo']; ?></sub><br>
                                        <i><?php echo $contacto['telefono']; ?></i><br>
                                        <i> <?php echo $contacto['correo']; ?></i><br>
                                        <i>____________________________________________</i>


                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <p><?php echo $seccion['cont1']; ?></p>
                    <p><?php echo $seccion['cont2']; ?></p>
                    <p><?php echo $seccion['cont3']; ?></p>
                    <?php if (isset($seccion['video']) && !empty($seccion['video'])): ?>
                        <video width="640" height="360" controls>
                            <source src="<?php echo $seccion['video']; ?>" type="video/mp4">

                        </video>
                    <?php endif; ?>

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