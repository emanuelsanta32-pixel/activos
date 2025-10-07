<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    $nombre_completo = $_POST['nombre_completo'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];
    $permisos = $_POST['permisos'];
    $estado = $_POST['estado'];
    $sql = "INSERT INTO roles_activos (nombre_usuario, contraseña, nombre_completo, email, telefono, rol, permisos, estado) VALUES ('$nombre_usuario', '$contraseña', '$nombre_completo', '$email', '$telefono', '$rol', '$permisos', '$estado')";
    $mensaje = mysqli_query($conn, $sql) ? "Usuario registrado correctamente." : "Error: " . mysqli_error($conn);
}
$result = mysqli_query($conn, "SELECT * FROM roles_activos");
?>
<!DOCTYPE html>
<html>
<head><title>Usuarios</title></head>
<body>
<h2>Registrar Nuevo Usuario</h2>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
<form method="POST">
    <input type="text" name="nombre_usuario" placeholder="Usuario" required>
    <input type="password" name="contraseña" placeholder="Contraseña" required>
    <input type="text" name="nombre_completo" placeholder="Nombre Completo">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="telefono" placeholder="Teléfono">
    <select name="rol">
        <option value="admin">Admin</option>
        <option value="supervisor">Supervisor</option>
        <option value="operador">Operador</option>
        <option value="consulta">Consulta</option>
    </select>
    <input type="text" name="permisos" placeholder='Permisos (JSON)'>
    <select name="estado">
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
    <button type="submit">Registrar</button>
</form>
<h2>Lista de Usuarios</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Usuario</th><th>Contraseña</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Rol</th><th>Permisos</th><th>Estado</th><th>Último Acceso</th><th>Creación</th><th>Actualización</th>
    </tr>
    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <tr>
        <?php foreach($row as $col) echo "<td>".htmlspecialchars($col)."</td>"; ?>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>