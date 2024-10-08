<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pyramid of Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
            margin-bottom: 20px;
        }

        .box {

            padding: 5px;
            margin: 5px;
            text-align: center;
            background-color: white;
        }

        .box1 {
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .box img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            display: block;
            margin-bottom: 10px;
            border: 2px solid red;
        }

        .title {
            background-color: red;
            color: white;
            padding: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="pyramid-container">

        <!-- Row 1 -->
        <div class="row">
            <div class="box">
                <img src="https://via.placeholder.com/100" alt="Image 1">
                <div class="title">Director</div>
            </div>
        </div>

        <!-- Row 2 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="https://via.placeholder.com/100" alt="Image 2">
                </div>
                <div class="title">Vicerrector Académico y Financiero</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="https://via.placeholder.com/100" alt="Image 3">
                </div>
                <div class="title">Vicerrector de Bienestar Universitario</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="https://via.placeholder.com/100" alt="Image 4">
                </div>
                <div class="title">Vicerrector de Investigaciones</div>
            </div>
        </div>

        <!-- Row 3 -->
        <div class="row">
            <div class="box">
                <div class="box1">
                    <img src="https://via.placeholder.com/100" alt="Image 5">
                </div>
                <div class="title">Directora de Calidad Académica</div>
            </div>
            <div class="box">
                <div class="box1">
                    <img src="https://via.placeholder.com/100" alt="Image 6">
                </div>
                <div class="title">Directora de Extensión y Proyección Social</div>
            </div>
            <!-- Add more boxes as needed -->
        </div>

        <!-- Continue adding rows here -->

    </div>

</body>

</html>