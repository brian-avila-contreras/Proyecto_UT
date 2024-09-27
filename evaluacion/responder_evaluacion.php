<?php include 'db.php'; ?>

<form action="evaluar_respuestas.php" method="post">
    <select name="evaluacion_id" required>
        <option value="">Selecciona una Evaluación</option>
        <?php
        $stmt = $pdo->query("SELECT * FROM evaluaciones");
        while ($row = $stmt->fetch()) {
            echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
        }
        ?>
    </select>
    <button type="submit" name="iniciar_evaluacion">Iniciar Evaluación</button>
</form>
