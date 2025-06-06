<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "rakionherousuarios";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
