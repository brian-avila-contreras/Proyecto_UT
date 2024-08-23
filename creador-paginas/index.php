<?php
session_start();
$uniqueFolder = 'media_' . session_id();
if (!file_exists($uniqueFolder)) {
    mkdir($uniqueFolder, 0777, true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/a076d05399.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=New+Amsterdam&display=swap"
        rel="stylesheet">

    <style>
        .navbar-brand img {
            height: 50px;
            /* Ajusta la altura del logo según sea necesario */
            width: auto;
            /* Mantiene la proporción del logo */
        }

        body {}

        /* Estilos para todos los inputs */
        .btn-outline-primary {
            font-size: 14px;
            padding: 2px;
            font-family: monospace;
        }

        .removeSection {
            font-size: 14px;
            padding: 2px;
            font-family: monospace;
            border: 1px solid red;
            background-color: transparent;
            transition: 0.3s ease, color 0.3s ease;
            border-radius: 5px;
            color: red;


        }

        .removeSection:hover {
            color: white;
            background-color: red;
            transition: 0.3s ease, color 0.3s ease;


        }

        .configContent {
            border: 1px dashed gray;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: left;
            padding: 10px;
        }

        /* Estilos específicos para tipos de inputs */
        .section-title {
            width: 30%;
        }

        input[type="file"] {
            display: block;
            margin: 10px 0;
            width: 100%;
        }

        input[type="number"] {
            width: 30%;
        }

        input[type="color"] {
            transform: translateY(5px);
            width: 30px;
            height: 30px;
            border: none;
            background-color: transparent;
            cursor: pointer;
            transition: background-color 0.3s ease;

        }


        .td1 {

            width: 70%;
            display: flex;
            justify-content: left;
            align-items: center;
        }

        .section1 {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: left;

        }

        .section {
            border: 2px dashed #eb3237;
            padding: 1%;
            margin: 1%;
            text-align: center;
        }

        .form-control {
            width: 100%;
        }

        .nombre {
            font-size: 18px;
            text-align: center;
            color: #A0A0A0;
            /* Gris suave para el texto */
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2%;
        }

        .nombre label {
            margin-right: 15px;
            color: #A0A0A0;
            /* Gris suave para el label */
            transition: color 0.3s ease;
            font-size: 18px;
            margin-top: 1%;
        }

        .nombre input {
            border: 1px solid #D3D3D3;
            /* Gris suave para el borde */
            background-color: #F0F0F0;
            /* Fondo gris suave */
            border-radius: 5px;
            cursor: pointer;
            color: black;
            /* Blanco para el texto al escribir */
            padding: 10px 15px;
            font-size: 16px;
            width: 250px;
            /* Tamaño mayor para el input */
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
            outline: none;
            /* Elimina el borde por defecto al enfocar */
            display: flex;
            align-items: center;
        }

        .nombre input::placeholder {
            color: #A0A0A0;
            /* Gris suave para el texto del placeholder */
        }

        .nombre input:hover,
        .nombre input:focus {
            border: 1px solid #FF6666;
            /* Rojo suave para el borde al pasar el ratón */
            background-color: #FFE5E5;
            /* Rojo suave para el fondo al pasar el ratón */
            color: black;
            /* Blanco para el texto al escribir */
        }

        .nombre label:hover {
            color: #FF6666;
            /* Rojo suave al pasar el ratón sobre el label */

        }

        /* Icono en el input */
        .nombre input::before {
            content: "\f007";
            /* Código del icono de FontAwesome para usuario */
            font-family: 'FontAwesome';
            /* Requiere que FontAwesome esté cargado */
            color: #FF6666;
            /* Rojo suave para el icono */
            font-size: 20px;
            margin-right: 10px;
            display: inline-block;
            vertical-align: middle;
        }

        /* Alineación del icono y el texto del input */
        .nombre input {
            padding-left: 40px;
            /* Espacio para el icono */
            text-align: center;
        }

        .nombre input::placeholder {
            color: #A0A0A0;
            /* Gris suave para el placeholder */
        }

        /* Estilo para el mensaje de especificación */
        .message {
            color: gray;
            /* Rojo suave para el mensaje */
            font-size: 15px;
            margin-top: 5px;
            display: none;
            /* Oculto por defecto */
        }

        #sectionsContainer label {
            margin-right: 3%;
            margin-top: 1%;
        }

        .container {
            font-family: "Comic Neue", cursive;
            font-weight: 700;
            font-style: normal;
            text-align: center;

        }

        .container .l1 {
            font-size: 30px;
        }

        #addSection {
            margin-left: 1%;
            background-color: #eb3237;
            padding: 2px;
            color: white;
            width: 10%;
            display: flex;
            justify-content: space-around;
            align-items: center;

        }

        #sectionType {
            font-size: 20px;
            width: 100%;
            color: black;
            text-align: center;
            padding: 2px;

        }

        #sectionsContainer {
            margin: 4%;
        }

        #savePage {

            background-color: #eb3237;
            padding: 2px;
            color: white;


        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pageNameInput = document.getElementById('pageName');
            const message = document.getElementById('message');

            pageNameInput.addEventListener('input', function () {
                // Muestra el mensaje de especificación
                message.style.display = 'block';

                // Elimina caracteres especiales, manteniendo solo letras y números
                this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');

                // Limita la longitud del valor a 12 caracteres
                if (this.value.length > 20) {
                    this.value = this.value.substring(0, 20);
                }

                // Convierte el texto a minúsculas
                this.value = this.value.toLowerCase();

                // Oculta el mensaje si el valor es válido
                if (this.value.length > 0 && /^[a-z0-9]{1,20}$/.test(this.value)) {
                    message.style.display = 'none';
                } else {
                    message.style.display = 'block';
                }
            });

            // Inicialmente mostrar el mensaje si hay un texto inválido
            pageNameInput.addEventListener('focus', function () {
                if (this.value.length === 0 || !/^[a-z0-9]{1,12}$/.test(this.value)) {
                    message.style.display = 'block';
                }
            });

            // Ocultar el mensaje cuando se enfoca fuera del input si es válido
            pageNameInput.addEventListener('blur', function () {
                if (this.value.length > 0 && /^[a-z0-9]{1,20}$/.test(this.value)) {
                    message.style.display = 'none';
                }
            });
        });
    </script>





</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Marca (Logo) -->
            <a class="navbar-brand" href="#">
                <img src="uploads/logo-ut.png" alt="Logo"> <!-- Reemplaza con la ruta a tu imagen -->
            </a>

            <!-- Botón para dispositivos móviles -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="nombre">
        <label for="pageName"><b>Ingrese el nombre de su página:</b></label>
        <input type="text" id="pageName" placeholder="Nombre de la página" required>
        <div id="message" class="message">Máximo 20 caracteres, solo letras y números, minúsculas</div>
    </div><br>


    <div class="container mt-4">
        <label for="titulo-secciones" class="l1">Secciones: </label>
        <div class="opciones d-flex">
            <select id="sectionType" class="custom-select">

                <option value="1">Título</option>
                <option value="2">Texto</option>
                <option value="3">Imagen</option>
                <option value="4">Video</option>
                <option value="5">URL</option>
                <option value="6">Título y Texto</option>
            </select>
            <button id="addSection" class="btn btn-icon">
                <i class="fas fa-plus"></i>sección
            </button>
        </div>

        <div id="sectionsContainer">
            <div class="section-number"></div>
        </div>

        <button id="savePage" class="btn" disabled>
            <i class="fas fa-save"></i> Guardar página
        </button>
    </div>

    <h2 style="text-align:center;">Vista Previa</h2>
    <div id="previewContainer">
        <!-- Aquí se generará la vista previa en tiempo real -->
    </div>

    <script src="c.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const saveButton = document.getElementById('savePage');
            const pageNameInput = document.getElementById('pageName');
            const messageDiv = document.getElementById('message');
            const sectionsContainer = document.getElementById('sectionsContainer');

            function updateSectionNumbers() {
                const sections = document.querySelectorAll('.section');
                sections.forEach((section, index) => {
                    let sectionNumber = section.querySelector('.section-number');
                    if (!sectionNumber) {
                        sectionNumber = document.createElement('div');
                        sectionNumber.classList.add('section-number');
                        section.insertBefore(sectionNumber, section.firstChild);
                    }
                    sectionNumber.textContent = `Sección ${index + 1}`;
                });
            }

            function validatePage() {
                const sections = document.querySelectorAll('.section');
                const sectionCount = sections.length;
                const pageName = pageNameInput.value.trim();
                const nameValid = /^[a-z0-9]{1,20}$/.test(pageName);

                let missingFields = 0;
                let sectionWithErrors = '';

                if (!nameValid) {
                    messageDiv.textContent = 'Nombre inválido: máximo 20 caracteres, solo letras y números, minúsculas';
                    saveButton.disabled = true;
                    saveButton.textContent = 'Guardar página (Nombre inválido)';
                    return;
                }

                if (sectionCount < 3) {
                    messageDiv.textContent = `Faltan ${3 - sectionCount} secciones`;
                    saveButton.disabled = true;
                    saveButton.textContent = `Guardar página (${3 - sectionCount} sección(es) faltante(s)`;
                    return;
                }

                sections.forEach((section, index) => {
                    const inputs = section.querySelectorAll('input[required], textarea[required]');
                    const hasMissingFields = Array.from(inputs).some(input => !input.value.trim());

                    if (hasMissingFields) {
                        sectionWithErrors = `Sección ${index + 1}`;
                    }

                    missingFields += Array.from(inputs).filter(input => !input.value.trim()).length;
                });

                if (missingFields > 0) {
                    messageDiv.textContent = `Complete los campos requeridos en ${sectionWithErrors}`;
                    saveButton.disabled = true;
                    saveButton.textContent = `Guardar página (${missingFields} campo(s) requerido(s)`;
                    return;
                }

                messageDiv.textContent = '';
                saveButton.disabled = false;
                saveButton.textContent = 'Guardar página';
            }

            function handleSectionChanges() {
                updateSectionNumbers();
                validatePage();
            }

            // Event listeners for inputs and changes within sections
            pageNameInput.addEventListener('input', validatePage);

            sectionsContainer.addEventListener('input', handleSectionChanges);
            sectionsContainer.addEventListener('change', handleSectionChanges);

            // Handle removal of sections
            sectionsContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('removeSection')) {
                    event.target.closest('.section').remove();
                    handleSectionChanges();
                }
            });

            // Handle addition of new sections
            sectionsContainer.addEventListener('DOMNodeInserted', function (event) {
                if (event.target.classList.contains('section')) {
                    handleSectionChanges();
                }
            });

            // Initial validation
            validatePage();
        });


    </script>
</body>

</html>