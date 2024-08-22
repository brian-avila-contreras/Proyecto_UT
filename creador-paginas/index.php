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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body{
            margin: 5px;
        }
        /* Estilos para todos los inputs */
        #btnb{
            font-size: 14px;
            padding: 2px;
            font-family: monospace;
        }
        .removeSection{
            font-size: 14px;
            padding: 2px;
            font-family: monospace;
            border: 1px solid red;
            background-color: transparent;
            transition: 0.3s ease, color 0.3s ease;
            border-radius: 5px;
            color:red;
            

        }
        .removeSection:hover{
            color:white;
            background-color: red;
            transition: 0.3s ease, color 0.3s ease;
            

        }
        .configContent{
            border: 1px dashed gray  ;
            width: 40%;
        }

        /* Estilos específicos para tipos de inputs */
        .section-title {
            width: 30%;
        }

        input[type="file"] {
            display: block;
            margin: 10px 0;
        }

        input[type="number"] {
            width: 80px;
        }

        .section-title-color {
            transform: translateY(5px);
            width: 30px;
            height: 30px;
            border: none;
            background-color: transparent;
            cursor: pointer;
            transition: background-color 0.3s ease;
       
        }
    </style>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const pageNameInput = document.getElementById('pageName');
            
            pageNameInput.addEventListener('input', function() {
                this.value = this.value.toLowerCase();
            });
        });
    </script>
</head>

<body>
    <div>
        <label for="pageName">Ingrese el nombre de su página:</label>
        <input type="text" id="pageName" placeholder="Nombre de la página">
    </div><br>

    <div class="opciones">
        <select id="sectionType">
            <option value="1">Título</option>
            <option value="2">Texto</option>
            <option value="3">Imagen</option>
            <option value="4">Video</option>
            <option value="5">URL</option>
            <option value="6">Título y Texto</option>
        </select>
        <button id="addSection">Agregar sección</button>
    </div>

    <div id="sectionsContainer">
        <!-- Secciones añadidas dinámicamente -->
    </div>

    <button id="savePage">Guardar página</button>

    <h2>Vista Previa</h2>
    <div id="previewContainer">
        <!-- Aquí se generará la vista previa en tiempo real -->
    </div>

    <script src="c.js"></script>

</body>

</html>
<div class="cfg"></div>