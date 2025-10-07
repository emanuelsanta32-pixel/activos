<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_ambiente = $_POST['nombre_ambiente'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad_maxima = $_POST['capacidad_maxima'];
    $responsable = $_POST['responsable'];
    $estado = $_POST['estado'];
    $sql = "INSERT INTO ambientes (nombre_ambiente, descripcion, ubicacion, capacidad_maxima, responsable, estado) VALUES ('$nombre_ambiente', '$descripcion', '$ubicacion', '$capacidad_maxima', '$responsable', '$estado')";
    $mensaje = mysqli_query($conn, $sql) ? "Ambiente registrado correctamente." : "Error: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT * FROM ambientes");
?>
<!DOCTYPE html>
<html>
<head><title>Ambientes</title></head>
<body>
<h2>Registrar Nuevo Ambiente</h2>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
<form method="POST">
    <input type="text" name="nombre_ambiente" placeholder="Nombre" required>
    <input type="text" name="descripcion" placeholder="Descripción">
    <input type="text" name="ubicacion" placeholder="Ubicación">
    <input type="number" name="capacidad_maxima" placeholder="Capacidad Máxima">
    <input type="text" name="responsable" placeholder="Responsable">
    <select name="estado">
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
        <option value="Mantenimiento">Mantenimiento</option>
    </select>
    <button type="submit">Registrar</button>
</form>
<h2>Lista de Ambientes</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Nombre</th><th>Descripción</th><th>Ubicación</th><th>Capacidad</th><th>Responsable</th><th>Estado</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
        <?php foreach($row as $col) echo "<td>".htmlspecialchars($col)."</td>"; ?>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>