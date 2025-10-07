<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $sql = "INSERT INTO categorias (nombre_categoria, descripcion, estado) VALUES ('$nombre_categoria', '$descripcion', '$estado')";
    $mensaje = mysqli_query($conn, $sql) ? "Categoría registrada correctamente." : "Error: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT * FROM categorias");
?>
<!DOCTYPE html>
<html>
<head><title>Categorías</title></head>
<body>
<h2>Registrar Nueva Categoría</h2>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
<form method="POST">
    <input type="text" name="nombre_categoria" placeholder="Nombre" required>
    <input type="text" name="descripcion" placeholder="Descripción">
    <select name="estado">
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
    <button type="submit">Registrar</button>
</form>
<h2>Lista de Categorías</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Nombre</th><th>Descripción</th><th>Estado</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
        <?php foreach($row as $col) echo "<td>".htmlspecialchars($col)."</td>"; ?>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>