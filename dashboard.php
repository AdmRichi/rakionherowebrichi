<?php
session_start();
if (!isset($_SESSION['email'])) {
    // Si no hay sesión activa, redirige al login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8" /><title>Dashboard</title></head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['email']) ?></h1>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>