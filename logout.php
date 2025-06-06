<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cerrando sesión...</title>
  <meta http-equiv="refresh" content="3;url=codigos.php">
  <style>
    body {
      background: url('img/fondo.png') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .mensaje {
      background-color: rgba(0, 0, 0, 0.75);
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 20px #ff00ea;
    }

    .mensaje h1 {
      margin-bottom: 15px;
    }

    .mensaje p {
      font-size: 16px;
      color: #ccc;
    }
  </style>
</head>
<body>
  <div class="mensaje">
    <h1>Sesión cerrada</h1>
    <p>Serás redirigido al login en unos segundos...</p>
  </div>
</body>
</html>
