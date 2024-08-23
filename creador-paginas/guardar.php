<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que el nombre de la página no esté vacío
    if (empty($_POST['pageName'])) {
        die('El nombre de la página es obligatorio.');
    }

    $pageName = basename($_POST['pageName']);
    $pageName = preg_replace('/[^a-zA-Z0-9_-]/', '', $pageName); // Limpiar el nombre del archivo
    $pageFile = $pageName . '.php';

    // Crear una carpeta para los archivos subidos si no existe
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Guardar archivos subidos
    $uploads = [];

    // Procesar imágenes y videos subidos
    foreach ($_FILES as $key => $file) {
        if ($file['error'] == UPLOAD_ERR_OK) {
            $uniqueName = uniqid() . '-' . basename($file['name']);
            $filePath = 'uploads/' . $uniqueName;
            move_uploaded_file($file['tmp_name'], $filePath);
            $uploads[$key] = $filePath;
        }
    }

    // Obtener los datos de las secciones
    $sections = json_decode($_POST['sections'], true);
    if ($sections === null) {
        die('Error al procesar las secciones.');
    }

    // Crear el contenido del archivo PHP
    ob_start();
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($pageName); ?></title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Agregar aquí el CSS dinámico generado */
            .navbar-brand img {
                height: 50px; /* Ajusta la altura del logo según sea necesario */
                width: auto; /* Mantiene la proporción del logo */
            }
            body {
                font-family: Arial, sans-serif;
            }

            <?php foreach ($sections as $index => $section): ?>.section-<?php echo $index; ?> {
                margin: 20px 0;
            }

            <?php if (isset($section['title'])): ?>.section-<?php echo $index; ?> h1 {
                color: <?php echo htmlspecialchars($section['titleColor']); ?>;
                text-align: <?php echo htmlspecialchars($section['titleAlignment']); ?>;
                font-size: <?php echo htmlspecialchars($section['titleFontSize']); ?>px;
                font-family: <?php echo htmlspecialchars($section['titleFontFamily']); ?>;
                margin: 0; /* Elimina márgenes para un ajuste más preciso */
                word-wrap: break-word; /* Asegura que el texto largo se divida para evitar desbordamiento */
            }

            <?php endif; ?><?php if (isset($section['text'])): ?>.section-<?php echo $index; ?> p {
                color: <?php echo htmlspecialchars($section['textColor']); ?>;
                text-align: <?php echo htmlspecialchars($section['textAlignment']); ?>;
                font-size: <?php echo htmlspecialchars($section['textFontSize']); ?>px;
                font-family: <?php echo htmlspecialchars($section['textFontFamily']); ?>;
                line-height: 1.5; /* Mejora la legibilidad del texto */
                word-wrap: break-word; /* Asegura que el texto largo se divida para evitar desbordamiento */
                margin: 0; /* Elimina márgenes para un ajuste más preciso */
            }

            <?php endif; ?><?php if (isset($section['image'])): ?>.section-<?php echo $index; ?> img {
                display: block;
                margin-left: <?php echo $section['imageAlignment'] == 'center' ? 'auto' : ($section['imageAlignment'] == 'left' ? '0' : 'auto'); ?>;
                margin-right: <?php echo $section['imageAlignment'] == 'center' ? 'auto' : ($section['imageAlignment'] == 'right' ? '0' : 'auto'); ?>;
                width: <?php echo htmlspecialchars($section['imageWidth']); ?>px;
                height: <?php echo htmlspecialchars($section['imageHeight']); ?>;
            }

            <?php endif; ?><?php if (isset($section['video'])): ?>.section-<?php echo $index; ?> video {
                display: block;
                margin-left: <?php echo $section['videoAlignment'] == 'center' ? 'auto' : ($section['videoAlignment'] == 'left' ? '0' : 'auto'); ?>;
                margin-right: <?php echo $section['videoAlignment'] == 'center' ? 'auto' : ($section['videoAlignment'] == 'right' ? '0' : 'auto'); ?>;
                width: <?php echo htmlspecialchars($section['videoWidth']); ?>px;
                height: <?php echo htmlspecialchars($section['videoHeight']); ?>;
            }

            <?php endif; ?><?php endforeach; ?>
        </style>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Marca (Logo) -->
                <a class="navbar-brand" href="#">
                    <img src="uploads/logo-ut.png" alt="Logo"> <!-- Reemplaza con la ruta a tu imagen -->
                </a>

                <!-- Botón para dispositivos móviles -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
        <?php foreach ($sections as $index => $section): ?>
            <div class="section-<?php echo $index; ?>">
                <?php if (isset($section['title'])): ?>
                    <h1><?php echo htmlspecialchars($section['title']); ?></h1>
                <?php endif; ?>
                <?php if (isset($section['text'])): ?>
                    <p><?php echo htmlspecialchars($section['text']); ?></p>
                <?php endif; ?>
                <?php if (isset($section['image']) && isset($uploads["image_$index"])): ?>
                    <img src="<?php echo htmlspecialchars($uploads["image_$index"]); ?>" alt="Imagen">
                <?php endif; ?>
                <?php if (isset($section['video']) && isset($uploads["video_$index"])): ?>
                    <video src="<?php echo htmlspecialchars($uploads["video_$index"]); ?>" controls></video>
                <?php endif; ?>
                <?php if (isset($section['url'])): ?>
                    <a href="<?php echo htmlspecialchars($section['url']); ?>" target="_blank"><?php echo htmlspecialchars($section['url']); ?></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
<?php

    // Guardar el archivo PHP
    $htmlContent = ob_get_clean();
    file_put_contents($pageFile, $htmlContent);

    echo 'Página guardada con éxito.';
} else {
    echo 'Método de solicitud no válido.';
}
?>
