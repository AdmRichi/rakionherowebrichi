<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Personaje</title>
  <style>
    body {
      background: url('./img/fondo.png') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      color: white;
      font-size: 18px;
    }

    .form-container {
      max-width: 600px;
      margin: 100px auto;
      background: rgba(0, 0, 0, 0.85);
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 30px #ff4d4d;
      border: 3px solid #ff4d4d;
      text-align: center;
      animation: fadeUp 1s ease-in-out;
    }

    h2 {
      margin-bottom: 25px;
      font-size: 42px;
      color: #ff4d4d;
      animation: pulseGlow 2s infinite;
      text-shadow: 0 0 10px #ff4d4d;
    }

    label {
      display: block;
      margin: 20px 0 10px;
      font-weight: bold;
      font-size: 20px;
      color: white;
    }

    input[type="text"],
    input[type="password"] {
      width: 95%;
      padding: 14px;
      font-size: 18px;
      border-radius: 10px;
      border: 2px solid #ff4d4d;
      background-color: #1a1a1a;
      color: white;
      margin-bottom: 20px;
    }

    button {
      background-color: #ff4d4d;
      color: white;
      font-weight: bold;
      font-size: 20px;
      padding: 14px 30px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 15px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #e63b3b;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulseGlow {
      0% {
        text-shadow: 0 0 10px #ff4d4d;
      }
      50% {
        text-shadow: 0 0 25px #ff4d4d;
      }
      100% {
        text-shadow: 0 0 10px #ff4d4d;
      }
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Eliminar Personaje</h2>
  <form action="procesar_eliminar.php" method="POST">
    <label for="id_ingreso">ID de Ingreso</label>
    <input type="text" name="id_ingreso" id="id_ingreso" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" required>

    <label for="nick">Nick del Personaje</label>
    <input type="text" name="nick" id="nick" required>

    <button type="submit">Borrar Personaje</button>
  </form>
</div>

</body>
</html>
