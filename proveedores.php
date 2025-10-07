<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $nit_ruc = $_POST['nit_ruc'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];
    $sql = "INSERT INTO proveedores (nombre_proveedor, nit_ruc, contacto, telefono, email, direccion, estado) VALUES ('$nombre_proveedor', '$nit_ruc', '$contacto', '$telefono', '$email', '$direccion', '$estado')";
    $mensaje = mysqli_query($conn, $sql) ? "Proveedor registrado correctamente." : "Error: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT * FROM proveedores");
?>
<!DOCTYPE html>
<html>
<head><title>Proveedores</title></head>
<body>
<h2>Registrar Nuevo Proveedor</h2>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
<form method="POST">
    <input type="text" name="nombre_proveedor" placeholder="Nombre" required>
    <input type="text" name="nit_ruc" placeholder="NIT/RUC">
    <input type="text" name="contacto" placeholder="Contacto">
    <input type="text" name="telefono" placeholder="Teléfono">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="direccion" placeholder="Dirección">
    <select name="estado">
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
    <button type="submit">Registrar</button>
</form>
<h2>Lista de Proveedores</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Nombre</th><th>NIT/RUC</th><th>Contacto</th><th>Teléfono</th><th>Email</th><th>Dirección</th><th>Estado</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
        <?php foreach($row as $col) echo "<td>".htmlspecialchars($col)."</td>"; ?>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>