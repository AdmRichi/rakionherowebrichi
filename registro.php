<?php
include("conexion.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"] ?? '';
    $email = $_POST["correo"] ?? '';
    $numero = $_POST["numero"] ?? '';
    $clave = $_POST["clave"] ?? '';
    $confirmar_clave = $_POST["confirmar_clave"] ?? '';

    if (empty($usuario) || empty($email) || empty($numero) || empty($clave) || empty($confirmar_clave)) {
        echo "<script>alert('Por favor completa todos los campos'); window.location.href='formulario.php';</script>";
        exit;
    }

    if ($clave !== $confirmar_clave) {
        echo "<script>alert('Las contraseñas no coinciden'); window.location.href='formulario.php';</script>";
        exit;
    }

    $contrasena = password_hash($clave, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (usuario, email, numero, contrasena) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $usuario, $email, $numero, $contrasena);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['usuario'] = $usuario; // Unificación de la sesión

        echo "<script>alert('¡Registro exitoso!'); window.location.href='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error al registrar: " . $stmt->error . "'); window.location.href='formulario.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: formulario.php");
    exit;
}
