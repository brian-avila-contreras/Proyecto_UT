<?php
session_start();
require 'db.php'; // Conectar a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('No has iniciado sesión.'); window.location.href = 'login.php';</script>"; // Redirigir a la página de inicio de sesión
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

if ($actividad == 0) {
    echo "<script>alert('Usted ya realizó la lectura y aceptó las secciones. No puede acceder nuevamente a esta página.'); window.location.href = 'login.php';</script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .pyramid-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        .row {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            width: 100%;
        }

        .box {
            width: 340px;
            height: auto;
            padding: 5px;
            margin: 5px;
            text-align: center;
            background-color: white;
            padding: 2px;
        }

        .box1 {
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            display: flex;
            border: 1px solid #eb4947;
        }

        .box1 a {
           color: #eb4947;
           text-decoration: none;
        }

        .info {
            width: 0%;
            height: auto;
            font-size: 0px;
            transition: all 0.3s ease-in-out;
        }

        .box1 img {
            width: 45%;
            height: auto;
            object-fit: cover;
            display: block;
            margin-bottom: 10px;
            border: 2px solid #eb4947;
            margin: 2px;
        }

        /* Al hacer hover en la imagen, aplicamos el estilo a .info */
        .box1:hover .info {
            width: 50%;
            height: 170px;
            padding: 5px;
            background-color: transparent;
            font-size: 14px;
            border: 1px solid #eb4947;
            color: black;
            margin: 5px;
            visibility: visible;
            /* Aseguramos que sea visible */
            opacity: 1;
            /* Para animar la aparición */
            transition: all 0.3s ease-in-out;
            /* Transición suave */
            font-family: sans-serif;
            /* Flexbox para centrar verticalmente y alinear a la izquierda */
            display: flex;
            flex-direction: column;
            /* Para que el contenido se alinee en una columna */
            justify-content: center;
            /* Centrado vertical */
            align-items: flex-start;
            /* Alineado a la izquierda */
        }

        .title {
            background-color: #eb4947;
            color: white;
            padding: 6px;
            font-size: 12px;
            width: 250px;
            margin-left: 50px;
        }

        .next-btn {
            padding: 10px 20px;
            background-color: #eb4947;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="pyramid-container">
        <a class="next-btn" id="nextBtn" href="index2.php">Volver</a>
        <!-- Row 1 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="../img/1.jpg" alt="Image 1">
                    <div class="info" id="info">
                        <p>Omar A. Mejía Patiño</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:omejia@ut.edu.co">omejia@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Director</div>

            </div>
        </div>
        <!-- Row 2 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="../img/2.jpg" alt="Image 2">
                    <div class="info" id="info">
                        <p>Martha Lucia Nuñez</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:vac@ut.edu.co">vac@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Vicerrectora de Docencia</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/3.jpg" alt="Image 3">
                    <div class="info" id="info">
                        <p>Mario Ricardo López</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:vad@ut.edu.co">vad@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Vicerrector Administrativo y Financiero</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/4.jpg" alt="Image 4">
                    <div class="info" id="info">
                        <p>Diego Alberto Polo Pa#eb4947es</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:vdh@ut.edu.co">vdh@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Vicerrector de Desarrollo Humano</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/5.jpg" alt="Image 5">
                    <div class="info" id="info">
                        <p>Jonh Jairo Mendez Arteaga</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:din@ut.edu.co">din@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Vicerrector de Investigación-Creación, Innovación, Extensión y Proyección Social
                </div>
            </div>
        </div>
        <!-- Row 3 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="../img/6.jfif" alt="Image 6">
                    <div class="info" id="info">
                        <p>Gloria Yolanda Ospina Pacheco</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:gloyosp@ut.edu.co">gloyosp@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Secretaría Académica General</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/7.jpg" alt="Image 7">
                    <div class="info" id="info">
                        <p>Marcela Barragan Urrea</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:odi@ut.edu.co">odi@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Directora de Planeación y Desarrollo Institucional</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/8.jpg" alt="Image 8">
                    <div class="info" id="info">
                        <p>Liliana Puentes Acosta</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:proysocialut@ut.edu.co">proysocialut@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Directora de Extensión y Proyección Social</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/9.jpg" alt="Image 9">
                    <div class="info" id="info">
                        <p>Juan David Gómez González</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:sgut@ut.edu.co">sgut@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Secretario General</div>
            </div>
        </div>

        <!-- Row 4 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="../img/10.jfif" alt="Image 10">
                    <div class="info" id="info">
                        <p>Adriana Paola Albarracín Calderón</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:"></a>
                    </div>
                </div>
                <div class="title">Directora de Aseguramiento de la Calidad</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/11.jpg" alt="Image 11">
                    <div class="info" id="info">
                        <p>Wilson Arnando Losada</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:ocid_ut@ut.edu.co">ocid_ut@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Director Oficina de Control Disciplinario Interno</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/12.jpg" alt="Image 12">
                    <div class="info" id="info">
                        <p>Claudia Viviana Álvarez Quintero</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:dcf@ut.edu.co">dcf@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Directora Contable y Financiero </div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/13.jpg" alt="Image 13">
                    <div class="info" id="info">
                        <p>Adriana del Pilar León García</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:ojc@ut.edu.co">ojc@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Directora Oficina Jurídica y Contractual</div>
            </div>
        </div>
        <!-- Row 5 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="../img/14.jpg" alt="Image 14">
                    <div class="info" id="info">
                        <p>Hernán Darío Mendieta</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:direc_ogt@ut.edu.co">direc_ogt@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Director de la Oficina de Tecnologías de la Información y las Comunicaciones</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/15.jfif" alt="Image 15">
                    <div class="info" id="info">
                        <p>Ethel Margarita Carvajal</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:emcarvajalb@ut.edu.co">emcarvajalb@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Directora de Oficina de Control Interno.</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/16.jpg" alt="Image 16">
                    <div class="info" id="info">
                        <p>Nayer Dassmeny Castañeda Moncaleano</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:"></a>
                    </div>
                </div>
                <div class="title">Directora de Admisiones, Registro y Control Académico</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/17.jpg" alt="Image 17">
                    <div class="info" id="info">
                        <p>Claudia Patricia Toro Niño</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:dsa@ut.edu.co">dsa@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Directora de Servicios Institucionales</div>
            </div>
        </div>
        <!-- Row 6 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="../img/18.jpg" alt="Image 18">
                    <div class="info" id="info">
                        <p>Yulieth Caterine Andrade Vallejo</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:drlp@ut.edu.co">drlp@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Dirección Gestión de Talento Humano</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/19.jpg" alt="Image 19">
                    <div class="info" id="info">
                        <p>Fabiano Numpaque</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:ori@ut.edu.co">ori@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Director de la Oficina de Relaciones Interinstitucionales e Internacionales</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/20.jfif" alt="Image 20">
                    <div class="info" id="info">
                        <p>Kelly Fernanda Aguiar</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:bu@ut.edu.co">bu@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Directora de Dirección de Bienestar Universitario</div>
            </div>
        </div>
        <!-- Row 7 -->
        <div class="row">

            <div class="box">
                <div class="box1">
                    <img src="../img/21.jpg" alt="Image 21">
                    <div class="info" id="info">
                        <p>Patricia Cervantes Botero</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:"></a>
                    </div>
                </div>
                <div class="title">Dirección Centro Cultural</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="../img/22.png" alt="Image 22">
                    <div class="info" id="info">
                        <p>Angelica Piedad Sandoval Aldana</p>
                        <sub>Directivo</sub>
                        <br>
                        <a href="mailto:din@ut.edu.co">din@ut.edu.co</a>
                    </div>
                </div>
                <div class="title">Dirección de Fomento a la Investigación-Creación e Innovación</div>
            </div>
        </div>

    </div>

</body>

</html>