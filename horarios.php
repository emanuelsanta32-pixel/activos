<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_activo = $_POST['id_activo'];
    $id_usuario = $_POST['id_usuario'];
    $tipo_movimiento = $_POST['tipo_movimiento'];
    $fecha_hora_salida = $_POST['fecha_hora_salida'];
    $fecha_hora_devolucion = $_POST['fecha_hora_devolucion'] ?: NULL;
    $id_ambiente_origen = $_POST['id_ambiente_origen'];
    $id_ambiente_destino = $_POST['id_ambiente_destino'];
    $motivo = $_POST['motivo'];
    $observaciones = $_POST['observaciones'];
    $estado = $_POST['estado'];
    $sql = "INSERT INTO horarios (id_activo, id_usuario, tipo_movimiento, fecha_hora_salida, fecha_hora_devolucion, id_ambiente_origen, id_ambiente_destino, motivo, observaciones, estado) VALUES ('$id_activo', '$id_usuario', '$tipo_movimiento', '$fecha_hora_salida', ".($fecha_hora_devolucion?"'$fecha_hora_devolucion'":"NULL").", '$id_ambiente_origen', '$id_ambiente_destino', '$motivo', '$observaciones', '$estado')";
    $mensaje = mysqli_query($conn, $sql) ? "Movimiento registrado correctamente." : "Error: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT * FROM horarios");
?>
<!DOCTYPE html>
<html>
<head><title>Horarios</title></head>
<body>
<h2>Registrar Nuevo Movimiento</h2>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
<form method="POST">
    <input type="number" name="id_activo" placeholder="ID Activo" required>
    <input type="number" name="id_usuario" placeholder="ID Usuario" required>
    <select name="tipo_movimiento">
        <option value="Préstamo">Préstamo</option>
        <option value="Devolución">Devolución</option>
        <option value="Traslado">Traslado</option>
        <option value="Mantenimiento">Mantenimiento</option>
    </select>
    <input type="datetime-local" name="fecha_hora_salida" required>
    <input type="datetime-local" name="fecha_hora_devolucion">
    <input type="number" name="id_ambiente_origen" placeholder="ID Ambiente Origen">
    <input type="number" name="id_ambiente_destino" placeholder="ID Ambiente Destino">
    <input type="text" name="motivo" placeholder="Motivo">
    <input type="text" name="observaciones" placeholder="Observaciones">
    <select name="estado">
        <option value="Pendiente">Pendiente</option>
        <option value="Completado">Completado</option>
        <option value="Retrasado">Retrasado</option>
        <option value="Cancelado">Cancelado</option>
    </select>
    <button type="submit">Registrar</button>
</form>
<h2>Lista de Movimientos</h2>
<table border="1">
    <tr>
        <th>ID</th><th>ID Activo</th><th>ID Usuario</th><th>Tipo</th><th>Salida</th><th>Devolución</th><th>Amb. Origen</th><th>Amb. Destino</th><th>Motivo</th><th>Obs</th><th>Estado</th><th>Creación</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
        <?php foreach($row as $col) echo "<td>".htmlspecialchars($col)."</td>"; ?>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>