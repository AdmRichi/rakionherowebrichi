<?php
session_start();

// Si el usuario no está logueado, redirigir a formulario.php (login)
if (!isset($_SESSION['email'])) {
    header("Location: formulario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Comprar Item</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('img/fondo.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      color: white;
      display: flex;
      flex-direction: column;
    }

    .top-bar {
      display: flex;
      justify-content: flex-end;
      padding: 15px 20px;
      background-color: rgba(0, 0, 0, 0.8);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
    }

    .top-bar button {
      background-color: rgba(0, 0, 0, 0.6);
      color: white;
      border: 2px solid #f9f5f4;
      padding: 10px 16px;
      border-radius: 20px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .top-bar button:hover {
      transform: scale(1.07);
      box-shadow: 0 0 25px #ff00ea;
      background-color: rgba(34, 0, 51, 0.8);
      border-color: #ff00ea;
      color: #ff00ea;
    }

    .form-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 100px; /* Para no tapar con la barra superior */
    }

    form {
      background: rgba(0, 0, 0, 0.7);
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px #ff00ea;
      width: 320px;
      text-align: center;
    }

    form h2 {
      margin-bottom: 25px;
      font-weight: bold;
      color: #ff00ea;
    }

    label {
      display: block;
      text-align: left;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: none;
      font-size: 16px;
    }

    input[type="submit"] {
      background-color: #ff00ea;
      color: white;
      border: none;
      padding: 12px 0;
      width: 100%;
      font-weight: bold;
      font-size: 18px;
      border-radius: 25px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #d000c9;
    }
  </style>
</head>
<body>

  <div class="top-bar">
    <button onclick="location.href='tienda.php'">Regresar a tienda</button>
  </div>

  <div class="form-container">
    <form action="procesar_compra.php" method="POST" autocomplete="off">
      <h2>Confirmar compra</h2>
      
      <label for="user_id">ID de ingreso:</label>
      <input type="text" id="user_id" name="user_id" required />

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required />

      <input type="submit" value="Comprar" />
    </form>
  </div>

</body>
</html>
