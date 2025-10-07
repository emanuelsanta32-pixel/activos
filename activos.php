<?php
include 'conexion.php';

$mensaje = "";

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_activo = $_POST['codigo_activo'];
    $nombre_activo = $_POST['nombre_activo'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $numero_serie = $_POST['numero_serie'];
    $valor_compra = $_POST['valor_compra'];
    $fecha_compra = $_POST['fecha_compra'];
    $proveedor = $_POST['proveedor'];
    $estado_fisico = $_POST['estado_fisico'];
    $estado_operacional = $_POST['estado_operacional'];
    $id_ambiente = $_POST['id_ambiente'];
    $vida_util_anos = $_POST['vida_util_anos'];
    $valor_depreciacion_anual = $_POST['valor_depreciacion_anual'];
    $valor_actual = $_POST['valor_actual'];
    $observaciones = $_POST['observaciones'];

    $sql = "INSERT INTO activos (codigo_activo, nombre_activo, descripcion, categoria, marca, modelo, numero_serie, valor_compra, fecha_compra, proveedor, estado_fisico, estado_operacional, id_ambiente, vida_util_anos, valor_depreciacion_anual, valor_actual, observaciones)
    VALUES ('$codigo_activo', '$nombre_activo', '$descripcion', '$categoria', '$marca', '$modelo', '$numero_serie', '$valor_compra', '$fecha_compra', '$proveedor', '$estado_fisico', '$estado_operacional', '$id_ambiente', '$vida_util_anos', '$valor_depreciacion_anual', '$valor_actual', '$observaciones')";

    if (mysqli_query($conn, $sql)) {
        $mensaje = "Activo registrado correctamente.";
    } else {
        $mensaje = "Error: " . mysqli_error($conn);
    }
}

// Consultar activos para mostrar en una tabla
$result = mysqli_query($conn, "SELECT * FROM activos");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Activos</title>
    <style>
        body { font-family: Arial; }
        form { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 6px; }
        th { background: #eee; }
        .mensaje { color: green; }
    </style>
</head>
<body>
    <h2>Registrar Nuevo Activo</h2>
    <?php if ($mensaje) echo "<p class='mensaje'>$mensaje</p>"; ?>
    <form method="POST">
        <input type="text" name="codigo_activo" placeholder="Código" required>
        <input type="text" name="nombre_activo" placeholder="Nombre" required>
        <input type="text" name="descripcion" placeholder="Descripción">
        <input type="text" name="categoria" placeholder="Categoría">
        <input type="text" name="marca" placeholder="Marca">
        <input type="text" name="modelo" placeholder="Modelo">
        <input type="text" name="numero_serie" placeholder="Número de Serie">
        <input type="number" step="0.01" name="valor_compra" placeholder="Valor Compra">
        <input type="date" name="fecha_compra" placeholder="Fecha Compra">
        <input type="text" name="proveedor" placeholder="Proveedor">
        <select name="estado_fisico">
            <option value="Excelente">Excelente</option>
            <option value="Bueno">Bueno</option>
            <option value="Regular">Regular</option>
            <option value="Malo">Malo</option>
        </select>
        <select name="estado_operacional">
            <option value="Operativo">Operativo</option>
            <option value="No Operativo">No Operativo</option>
            <option value="En Mantenimiento">En Mantenimiento</option>
            <option value="Dado de Baja">Dado de Baja</option>
        </select>
        <input type="number" name="id_ambiente" placeholder="ID Ambiente">
        <input type="number" name="vida_util_anos" placeholder="Vida Útil (años)">
        <input type="number" step="0.01" name="valor_depreciacion_anual" placeholder="Depreciación Anual">
        <input type="number" step="0.01" name="valor_actual" placeholder="Valor Actual">
        <input type="text" name="observaciones" placeholder="Observaciones">
        <button type="submit">Registrar</button>
    </form>

    <h2>Lista de Activos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>N° Serie</th>
            <th>Valor Compra</th>
            <th>Fecha Compra</th>
            <th>Proveedor</th>
            <th>Estado Físico</th>
            <th>Estado Operacional</th>
            <th>ID Ambiente</th>
            <th>Vida Útil</th>
            <th>Dep. Anual</th>
            <th>Valor Actual</th>
            <th>Observaciones</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <?php foreach($row as $col): ?>
                <td><?php echo htmlspecialchars($col); ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>