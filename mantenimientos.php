<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_activo = $_POST['id_activo'];
    $tipo_mantenimiento = $_POST['tipo_mantenimiento'];
    $fecha_mantenimiento = $_POST['fecha_mantenimiento'];
    $descripcion_trabajo = $_POST['descripcion_trabajo'];
    $costo = $_POST['costo'];
    $proveedor_servicio = $_POST['proveedor_servicio'];
    $id_usuario_responsable = $_POST['id_usuario_responsable'];
    $estado = $_POST['estado'];
    $sql = "INSERT INTO mantenimientos (id_activo, tipo_mantenimiento, fecha_mantenimiento, descripcion_trabajo, costo, proveedor_servicio, id_usuario_responsable, estado) VALUES ('$id_activo', '$tipo_mantenimiento', '$fecha_mantenimiento', '$descripcion_trabajo', '$costo', '$proveedor_servicio', '$id_usuario_responsable', '$estado')";
    $mensaje = mysqli_query($conn, $sql) ? "Mantenimiento registrado correctamente." : "Error: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT * FROM mantenimientos");
?>
<!DOCTYPE html>
<html>
<head><title>Mantenimientos</title></head>
<body>
<h2>Registrar Nuevo Mantenimiento</h2>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
<form method="POST">
    <input type="number" name="id_activo" placeholder="ID Activo" required>
    <select name="tipo_mantenimiento">
        <option value="Preventivo">Preventivo</option>
        <option value="Correctivo">Correctivo</option>
        <option value="Predictivo">Predictivo</option>
    </select>
    <input type="date" name="fecha_mantenimiento" required>
    <input type="text" name="descripcion_trabajo" placeholder="Descripción Trabajo">
    <input type="number" step="0.01" name="costo" placeholder="Costo">
    <input type="text" name="proveedor_servicio" placeholder="Proveedor Servicio">
    <input type="number" name="id_usuario_responsable" placeholder="ID Usuario Responsable">
    <select name="estado">
        <option value="Programado">Programado</option>
        <option value="En Proceso">En Proceso</option>
        <option value="Completado">Completado</option>
        <option value="Cancelado">Cancelado</option>
    </select>
    <button type="submit">Registrar</button>
</form>
<h2>Lista de Mantenimientos</h2>
<table border="1">
    <tr>
        <th>ID</th><th>ID Activo</th><th>Tipo</th><th>Fecha</th><th>Descripción</th><th>Costo</th><th>Proveedor</th><th>ID Responsable</th><th>Estado</th><th>Creación</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
        <?php foreach($row as $col) echo "<td>".htmlspecialchars($col)."</td>"; ?>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>