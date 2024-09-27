<?php include 'db.php'; ?>

<form id="preguntasForm" action="guardar_preguntas.php" method="post">
    <label for="evaluacion_id">Selecciona una Evaluación:</label>
    <select name="evaluacion_id" id="evaluacion_id" required>
        <option value="">Selecciona una Evaluación</option>
        <?php
        $stmt = $pdo->query("SELECT * FROM evaluaciones");
        while ($row = $stmt->fetch()) {
            echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
        }
        ?>
    </select>
    <div id="preguntasContainer">
        <!-- Aquí se añadirán las preguntas dinámicamente -->
    </div>
    <button type="button" id="addQuestionButton">Añadir Pregunta</button>
    <button type="submit">Guardar Preguntas</button>
</form>

<script>
document.getElementById('addQuestionButton').addEventListener('click', function() {
    const container = document.getElementById('preguntasContainer');
    
    // Crear nuevo grupo de campos para la pregunta y respuestas
    const newQuestion = document.createElement('div');
    newQuestion.classList.add('question-group');
    
    newQuestion.innerHTML = `
        <h3>Pregunta</h3>
        <textarea name="pregunta[]" placeholder="Escribe la pregunta" required></textarea>
        <h4>Opciones de Respuesta</h4>
        <input type="text" name="respuesta_a[]" placeholder="Opción A" required>
        <input type="text" name="respuesta_b[]" placeholder="Opción B" required>
        <input type="text" name="respuesta_c[]" placeholder="Opción C" required>
        <input type="text" name="respuesta_d[]" placeholder="Opción D" required>
        <select name="correcta[]" required>
            <option value="A">Correcta: A</option>
            <option value="B">Correcta: B</option>
            <option value="C">Correcta: C</option>
            <option value="D">Correcta: D</option>
        </select>
        <hr>
    `;
    
    container.appendChild(newQuestion);
});
</script>
