<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_activo = $_POST['id_activo'];
    $anio = $_POST['anio'];
    $valor_inicial = $_POST['valor_inicial'];
    $depreciacion_anual = $_POST['depreciacion_anual'];
    $depreciacion_acumulada = $_POST['depreciacion_acumulada'];
    $valor_en_libros = $_POST['valor_en_libros'];
    $sql = "INSERT INTO depreciaciones (id_activo, año, valor_inicial, depreciacion_anual, depreciacion_acumulada, valor_en_libros) VALUES ('$id_activo', '$anio', '$valor_inicial', '$depreciacion_anual', '$depreciacion_acumulada', '$valor_en_libros')";
    $mensaje = mysqli_query($conn, $sql) ? "Depreciación registrada correctamente." : "Error: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT * FROM depreciaciones");
?>
<!DOCTYPE html>
<html>
<head><title>Depreciaciones</title></head>
<body>
<h2>Registrar Nueva Depreciación</h2>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
<form method="POST">
    <input type="number" name="id_activo" placeholder="ID Activo" required>
    <input type="number" name="anio" placeholder="Año" required>
    <input type="number" step="0.01" name="valor_inicial" placeholder="Valor Inicial">
    <input type="number" step="0.01" name="depreciacion_anual" placeholder="Depreciación Anual">
    <input type="number" step="0.01" name="depreciacion_acumulada" placeholder="Depreciación Acumulada">
    <input type="number" step="0.01" name="valor_en_libros" placeholder="Valor en Libros">
    <button type="submit">Registrar</button>
</form>
<h2>Lista de Depreciaciones</h2>
<table border="1">
    <tr>
        <th>ID</th><th>ID Activo</th><th>Año</th><th>Valor Inicial</th><th>Dep. Anual</th><th>Dep. Acumulada</th><th>Valor en Libros</th><th>Fecha Cálculo</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
        <?php foreach($row as $col) echo "<td>".htmlspecialchars($col)."</td>"; ?>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>