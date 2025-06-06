<?php
session_start();
include 'header.php';  // aquí se carga el header PHP con toda la lógica de sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Descargas - RkHero</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: url('img/fondo.png') no-repeat center center/cover;
}

.downloads-section {
  padding: 140px 0 80px;
  text-align: center;
  animation: fadeInUp 1s ease forwards;
  opacity: 0;
  transform: translateY(30px);
}

.downloads-section h1 {
  color: #ff0000; /* rojo puro */
  font-size: 3rem;
  margin-bottom: 40px;
  text-transform: uppercase;
  letter-spacing: 4px;
  animation: neonPulseRed 2.5s ease-in-out infinite, fadeInDown 1s ease forwards;
  text-shadow:
    0 0 5px #ff0000,
    0 0 10px #ff0000,
    0 0 20px #ff0000,
    0 0 30px #ff0000,
    0 0 40px #ff0000,
    0 0 55px #ff0000,
    0 0 75px #ff0000;
}

.downloads-container {
  display: flex;
  justify-content: center;
  gap: 40px;
  flex-wrap: wrap;
}

.download-box a {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.6);
  border: 2px solid #f9f5f4;
  border-radius: 20px;
  padding: 30px;
  width: 250px;
  height: 200px;
  text-decoration: none;
  transition: all 0.3s ease;
  cursor: pointer;
}

.download-box a:hover {
  transform: scale(1.07);
  box-shadow: 0 0 25px #ff00ea;
  background-color: rgba(34, 0, 51, 0.8);
  border-color: #ff00ea;
}

.download-box img {
  width: 100px;
  margin-bottom: 10px;
  transition: transform 0.3s ease;
}

.download-box a:hover img {
  transform: scale(1.1) rotate(3deg);
}

.download-box p {
  color: #fff;
  font-size: 18px;
  font-weight: bold;
  margin: 0;
  transition: color 0.3s ease;
}

.download-box a:hover p {
  color: #ff00ea;
}

.volver {
  margin-top: 40px;
  display: inline-block;
  background-color: #aa00ff;
  color: white;
  padding: 12px 24px;
  border-radius: 10px;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.7s ease-in-out;
  box-shadow: 0 0 8px #aa00ff;
}

.volver:hover {
  background-color: #8a00cc;
  transform: scale(1.05);
  box-shadow: 0 0 20px #ff00ea, 0 0 30px #ff00ea;
}

@keyframes neonPulseRed {
  0%, 100% {
    text-shadow:
      0 0 5px #ff0000,
      0 0 10px #ff0000,
      0 0 20px #ff0000,
      0 0 30px #ff0000,
      0 0 40px #ff0000,
      0 0 55px #ff0000,
      0 0 75px #ff0000;
    color: #ff0000;
  }
  50% {
    text-shadow:
      0 0 10px #ff4d4d,
      0 0 20px #ff4d4d,
      0 0 30px #ff6666,
      0 0 40px #ff6666,
      0 0 50px #ff6666,
      0 0 65px #ff6666,
      0 0 85px #ff6666;
    color: #ff4d4d;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    transform: translateY(-20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

  </style>
</head>
<body>

  <section class="downloads-section">
    <h1>LINKS DE DESCARGA</h1>
    <div class="downloads-container">
      <div class="download-box">
        <a href="https://mega.nz/file/060hHCyK#duCYHP7ms7VULjI8oZ0oAzO4tuU7xGoZyFhQMYEX2GI" target="_blank" rel="noopener noreferrer">
          <img src="img/mega.png" alt="Mega" />
          <p>MEGA</p>
        </a>
      </div>
      <div class="download-box">
        <a href="https://www.mediafire.com/file/ceiiomfnh5ghfws/Rakion+Hero+v1.5.exe/file" target="_blank" rel="noopener noreferrer">
          <img src="img/mediafire.png" alt="MediaFire" />
          <p>MEDIAFIRE</p>
        </a>
      </div>
      <div class="download-box">
        <a href="https://drive.google.com/file/d/11OQdIKkx6D_O5Gj_60-lhSEH_-n7JxVu/view?usp=sharing" target="_blank" rel="noopener noreferrer">
          <img src="img/google_drive.png" alt="Google Drive" />
          <p>GOOGLE DRIVE</p>
        </a>
      </div>
    </div>
    <a href="index.php" class="volver">← Volver al inicio</a>
  </section>

</body>
</html>
