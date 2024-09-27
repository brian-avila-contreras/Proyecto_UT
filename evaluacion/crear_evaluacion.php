<?php include 'db.php'; ?>

<form action="" method="post">
    <input type="text" name="titulo" placeholder="Título de la Evaluación" required>
    <button type="submit" name="crear_evaluacion">Crear Evaluación</button>
</form>

<?php
if (isset($_POST['crear_evaluacion'])) {
    $titulo = $_POST['titulo'];
    $stmt = $pdo->prepare("INSERT INTO evaluaciones (titulo) VALUES (?)");
    $stmt->execute([$titulo]);
    echo "Evaluación creada con éxito!";
}
?>
