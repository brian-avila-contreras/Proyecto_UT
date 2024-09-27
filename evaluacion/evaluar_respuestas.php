<?php include 'db.php'; ?>

<?php
if (isset($_POST['iniciar_evaluacion'])) {
    $evaluacion_id = $_POST['evaluacion_id'];

    $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE evaluacion_id = ?");
    $stmt->execute([$evaluacion_id]);
    $preguntas = $stmt->fetchAll();

    echo "<form action='evaluar_respuestas.php' method='post'>";
    foreach ($preguntas as $pregunta) {
        echo "<p>{$pregunta['pregunta']}</p>";

        $stmt_respuestas = $pdo->prepare("SELECT * FROM respuestas WHERE pregunta_id = ?");
        $stmt_respuestas->execute([$pregunta['id']]);
        $respuestas = $stmt_respuestas->fetchAll();

        foreach ($respuestas as $respuesta) {
            echo "<input type='radio' name='respuesta_{$pregunta['id']}' value='{$respuesta['id']}' required> {$respuesta['respuesta']}<br>";
        }
    }
    echo "<input type='hidden' name='evaluacion_id' value='{$evaluacion_id}'>";
    echo "<button type='submit' name='enviar_respuestas'>Enviar Respuestas</button>";
    echo "</form>";
}
?>

<?php
if (isset($_POST['enviar_respuestas'])) {
    $evaluacion_id = $_POST['evaluacion_id'];
    $correctas = 0;
    $total = 0;

    foreach ($_POST as $key => $respuesta_id) {
        if (strpos($key, 'respuesta_') !== false) {
            $pregunta_id = str_replace('respuesta_', '', $key);
            $stmt = $pdo->prepare("INSERT INTO respuestas_usuarios (pregunta_id, respuesta_id) VALUES (?, ?)");
            $stmt->execute([$pregunta_id, $respuesta_id]);

            $stmt_correcta = $pdo->prepare("SELECT es_correcta FROM respuestas WHERE id = ?");
            $stmt_correcta->execute([$respuesta_id]);
            $es_correcta = $stmt_correcta->fetchColumn();

            if ($es_correcta) {
                $correctas++;
            }
            $total++;
        }
    }

    echo "<p>Respuestas correctas: $correctas de $total</p>";
}
?>
