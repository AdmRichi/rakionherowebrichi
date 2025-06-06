<?php
session_start();

// Aquí debes tener tu conexión a la base de datos
// Por ejemplo (ajusta según tu configuración):
$host = 'localhost';
$db = 'nombre_de_tu_base';
$user = 'tu_usuario';
$pass = 'tu_contraseña';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Verificar que el usuario esté logueado (opcional, pero recomendable)
if (!isset($_SESSION['email'])) {
    header("Location: formulario.php");
    exit();
}

// Recibir datos del formulario
$user_id = $_POST['user_id'] ?? '';
$password = $_POST['password'] ?? '';

// Validar que no estén vacíos
if (empty($user_id) || empty($password)) {
    die("Por favor completa todos los campos.");
}

// Consultar usuario en la base de datos para validar ID y contraseña
// Supongamos que tu tabla de usuarios se llama 'usuarios' y tiene campos 'id_usuario' y 'password' (hashed)

// Preparar consulta segura
$stmt = $pdo->prepare("SELECT email, password FROM usuarios WHERE id_usuario = :id_usuario LIMIT 1");
$stmt->bindParam(':id_usuario', $user_id, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("ID de usuario no encontrado.");
}

// Verificar contraseña (asumiendo que está encriptada con password_hash)
if (!password_verify($password, $user['password'])) {
    die("Contraseña incorrecta.");
}

// Aquí ya el usuario está validado para proceder con la compra
// Como ejemplo simple, mostrar mensaje éxito con enlace para volver a tienda

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Compra Exitosa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('img/fondo.png');
      background-size: cover;
      background-position: center;
      color: white;
      text-align: center;
      padding-top: 150px;
    }
    .mensaje {
      background: rgba(0, 0, 0, 0.7);
      display: inline-block;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px #ff00ea;
    }
    a {
      color: #ff00ea;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
      border: 2px solid #ff00ea;
      padding: 10px 20px;
      border-radius: 25px;
      transition: background-color 0.3s ease;
    }
    a:hover {
      background-color: #ff00ea;
      color: black;
    }
  </style>
</head>
<body>

  <div class="mensaje">
    <h1>Compra realizada con éxito!</h1>
    <p>Gracias por tu compra, <?= htmlspecialchars($user['email']) ?>.</p>
    <a href="tienda.php">Volver a la tienda</a>
  </div>

</body>
</html>
