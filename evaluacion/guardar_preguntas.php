<?php include 'db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $evaluacion_id = $_POST['evaluacion_id'];
    $preguntas = $_POST['pregunta'];
    $respuestas_a = $_POST['respuesta_a'];
    $respuestas_b = $_POST['respuesta_b'];
    $respuestas_c = $_POST['respuesta_c'];
    $respuestas_d = $_POST['respuesta_d'];
    $correctas = $_POST['correcta'];

    foreach ($preguntas as $index => $pregunta) {
        $stmt_pregunta = $pdo->prepare("INSERT INTO preguntas (evaluacion_id, pregunta) VALUES (?, ?)");
        $stmt_pregunta->execute([$evaluacion_id, $pregunta]);

        $pregunta_id = $pdo->lastInsertId();

        $respuestas = [
            'A' => $respuestas_a[$index],
            'B' => $respuestas_b[$index],
            'C' => $respuestas_c[$index],
            'D' => $respuestas_d[$index]
        ];

        foreach ($respuestas as $letra => $texto) {
            $es_correcta = ($correctas[$index] == $letra) ? 1 : 0;
            $stmt_respuesta = $pdo->prepare("INSERT INTO respuestas (pregunta_id, respuesta, es_correcta) VALUES (?, ?, ?)");
            $stmt_respuesta->execute([$pregunta_id, $texto, $es_correcta]);
        }
    }

    echo "Preguntas guardadas con éxito!";
}
?>
