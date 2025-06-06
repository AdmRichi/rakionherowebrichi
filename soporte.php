<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Soporte</title>
  <style>
    body {
      background: url('./img/fondo.png') no-repeat center center fixed;
      background-size: cover;
      color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .contenedor {
      max-width: 900px;
      margin: 30px auto;
      padding: 30px;
      background-color: rgba(0, 0, 0, 0.75);
      border-radius: 15px;
      border: 2px solid #ff4d4d;
      box-shadow: 0 0 20px #ff4d4d;
      animation: aparecer 1s ease-in-out;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .video {
      margin-bottom: 30px;
      animation: fadeIn 1s ease forwards;
      border: 2px solid #ff4d4d;
      border-radius: 10px;
      padding: 15px;
    }

    iframe {
      width: 100%;
      height: 400px;
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 10px #ff4d4d;
    }

    .video button {
      margin-top: 10px;
      background-color: #ff4d4d;
      color: white;
      font-weight: bold;
      padding: 10px 25px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .video button:hover {
      background-color: #e63b3b;
    }

    .video .titulo {
      font-size: 1.3em;
      font-weight: bold;
      text-align: center;
      margin-bottom: 10px;
    }

    .video.centro {
      text-align: center;
    }

    .contacto {
      margin-top: 50px;
      padding-top: 20px;
      border-top: 2px solid #ff4d4d;
      animation: aparecer 1s ease-in-out;
    }

    .contacto h2 {
      margin-bottom: 15px;
    }

    .contacto form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .contacto input, .contacto textarea {
      width: 100%;
      max-width: 600px;
      margin: 10px 0;
      padding: 10px;
      border-radius: 8px;
      border: 2px solid #ff4d4d;
      background-color: #1a1a1a;
      color: white;
    }

    .contacto button, .contacto a.whatsapp-btn {
      font-weight: bold;
      padding: 10px 25px;
      margin-top: 10px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }

    .contacto button {
      background-color: #ff4d4d;
      color: white;
    }

    .contacto button:hover {
      background-color: #e63b3b;
    }

    .contacto a.whatsapp-btn {
      background-color: #25D366;
      color: white;
      margin-left: 10px;
    }

    .botones {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      margin-top: 15px;
    }

    @keyframes aparecer {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>

<div class="contenedor">
  <h1>Soporte y Ayuda</h1>

  <div class="video">
    <div class="titulo">❗ ERROR: No se conecta el servidor</div>
    <iframe src="https://www.youtube.com/embed/1DGKDmxQ8j0?si=RCN6_AczOzLHumLm" allowfullscreen></iframe>
    <button onclick="window.open('https://www.youtube.com/watch?v=1DGKDmxQ8j0', '_blank')">Ver →</button>
  </div>

  <div class="video">
    <div class="titulo">🖥 Cómo configurar la resolución de juego y pantalla completa</div>
    <iframe src="https://www.youtube.com/embed/QMlC6X5SxN0?si=twOu4XUJos0ClFpJ" allowfullscreen></iframe>
    <button onclick="window.open('https://www.youtube.com/watch?v=QMlC6X5SxN0', '_blank')">Ver →</button>
  </div>

  <div class="video">
    <div class="titulo">🌎 ¿Problemas de FPS o lentitud?</div>
    <iframe src="https://www.youtube.com/embed/VLeGBnrFyW8" allowfullscreen></iframe>
    <button onclick="window.open('https://www.youtube.com/watch?v=VLeGBnrFyW8', '_blank')">Ver →</button>
  </div>

  <div class="video centro">
    <div class="titulo">🛠 Ejecuta este parche y reinicia:</div>
    <button onclick="window.open('https://www.mediafire.com/file/n71rokmort3va62/102100101_Fixed_FPS.reg/file', '_blank')">Descargar Parche FPS</button>
  </div>

  <div class="video">
    <div class="titulo">🔰 Antivirus y Exclusiones en Windows 10/11</div>
    <iframe src="https://www.youtube.com/embed/95LFUuW_91E?start=70" allowfullscreen></iframe>
    <button onclick="window.open('https://youtu.be/95LFUuW_91E?t=70', '_blank')">Ver →</button>
  </div>

  <div class="video centro">
    <div class="titulo">🌐 ¿Incompatibilidad de NAT o LAG?</div>
    <button onclick="window.open('https://www.tunnelbear.com/', '_blank')">Visitar TunnelBear</button>
  </div>

  <div class="video">
    <div class="titulo">📂 Cómo excluir carpetas del antivirus</div>
    <iframe src="https://www.youtube.com/embed/E89uvxBLKww?si=6TqNr8lbZuzNO1l3" allowfullscreen></iframe>
    <button onclick="window.open('https://youtu.be/E89uvxBLKww?si=6TqNr8lbZuzNO1l3', '_blank')">Ver →</button>
  </div>

  <div class="contacto">
    <h2>Contacto directo</h2>
    <form>
      <input type="text" placeholder="Tu nombre" required>
      <input type="email" placeholder="Tu correo" required>
      <textarea rows="5" placeholder="Escribe tu mensaje..." required></textarea>
      <div class="botones">
        <button type="submit">Enviar mensaje</button>
        <a class="whatsapp-btn" href="https://chat.whatsapp.com/HdzheJXfD2SK1nWlOEarJw" target="_blank">WhatsApp →</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
