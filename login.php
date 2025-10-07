<?php
session_start();

$host = "localhost";
$usuarioDB = "root";
$passwordDB = "";
$nombreDB = "activos";

$conn = new mysqli($host, $usuarioDB, $passwordDB, $nombreDB);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT id_usuario, nombre_usuario, contraseña, nombre_completo, rol, estado FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Mostrar los valores recuperados para depurar
        echo "<pre>";
        echo "Usuario ingresado: "; var_dump($usuario);
        echo "Usuario en BD: "; var_dump($row['nombre_usuario']);
        echo "Password ingresado: "; var_dump($password);
        echo "Hash en BD: "; var_dump($row['contraseña']);
        echo "Estado en BD: "; var_dump($row['estado']);
        echo "</pre>";

        // Comparación de estado
        if (strcasecmp(trim($row['estado']), "activo") !== 0) {
            $error = "Estado: El usuario no está activo (valor en BD: '{$row['estado']}')";
        } else {
            // Comparación de contraseña
            if (password_verify($password, $row['contraseña'])) {
                $_SESSION["id_usuario"] = $row['id_usuario'];
                $_SESSION["nombre_usuario"] = $row['nombre_usuario'];
                $_SESSION["nombre_completo"] = $row['nombre_completo'];
                $_SESSION["rol"] = $row['rol'];

                $ip = $_SERVER['REMOTE_ADDR'];
                $actualizacion = date("Y-m-d H:i:s");
                $update = $conn->prepare("UPDATE usuarios SET ultimo_acceso = ?, ip_ultimo_acceso = ?, intentos_login = 0 WHERE id_usuario = ?");
                $update->bind_param("ssi", $actualizacion, $ip, $row['id_usuario']);
                $update->execute();

                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Contraseña: La contraseña ingresada no coincide con el hash almacenado.";
            }
        }
    } else {
        $error = "Usuario: No existe el usuario '$usuario' en la base de datos.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Activos (DEPURACIÓN)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { max-width: 320px; margin: auto; border: 1px solid #ccc; padding: 20px; border-radius: 8px;}
        label, input { display: block; width: 100%; margin-bottom: 10px; }
        button { width: 100%; padding: 10px; }
        .error { color: red; }
        pre { background: #f7f7f7; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Iniciar Sesión (DEPURACIÓN)</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form action="login.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required autofocus>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>