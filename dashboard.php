<?php
session_start();
if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Activos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .bienvenida { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="bienvenida">
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION["nombre_completo"]); ?>!</h2>
        <p>Rol: <?php echo htmlspecialchars($_SESSION["rol"]); ?></p>
        <a href="logout.php">Cerrar sesión</a>
    </div>
    <hr>
    <!-- Aquí puedes poner el contenido principal del sistema de activos -->
    <p>Este es el panel principal del sistema de gestión de activos.</p>
</body>
</html>