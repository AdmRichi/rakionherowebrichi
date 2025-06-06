<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ANUNCIOS</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      background-color: rgba(0, 0, 0, 0.8);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
      flex-wrap: wrap;
    }

    .navbar-left, .navbar-right {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      transition: max-height 0.4s ease, opacity 0.4s ease, transform 0.4s ease;
    }

    .navbar-left a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    .navbar-left a:hover {
      color: rgb(255, 0, 0);
    }

    .navbar-right {
      align-items: center;
    }

    .navbar-right span {
      margin-right: 10px;
    }

    .navbar-right button {
      background-color: rgba(0, 0, 0, 0.6);
      color: white;
      border: 2px solid #f9f5f4;
      padding: 10px 16px;
      border-radius: 20px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .navbar-right button:hover {
      transform: scale(1.07);
      box-shadow: 0 0 25px #ff00ea;
      background-color: rgba(34, 0, 51, 0.8);
      border-color: #ff00ea;
      color: #ff00ea;
    }

    .social-icons {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .social-icons a {
      color: white;
      font-size: 20px;
      transition: color 0.3s ease;
    }

    .social-icons a:hover {
      color: rgb(252, 19, 221);
    }

    .social-icons .fa-whatsapp {
      color: #25D366;
    }

    .social-icons .fa-discord {
      color: #7289DA;
    }

    .menu-toggle {
      display: none;
      font-size: 24px;
      background: none;
      border: none;
      color: white;
      cursor: pointer;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .menu-toggle {
        display: block;
        align-self: flex-end;
      }

      .navbar-left,
      .navbar-right {
        flex-direction: column;
        align-items: center;
        overflow: hidden;
        max-height: 0;
        opacity: 0;
        width: 100%;
        text-align: center;
      }

      .navbar-left.active,
      .navbar-right.active {
        max-height: 1000px;
        opacity: 1;
      }

      .navbar-right button {
        width: 100%;
        margin-bottom: 10px;
      }

      .navbar-right span {
        margin-bottom: 5px;
      }
    }

    .contenido {
      padding-top: 100px;
      text-align: center;
    }

    .anuncios-container {
      display: grid;
      gap: 20px;
      padding: 20px;
      max-width: 800px;
      margin: 0 auto;
    }

    .anuncio-card {
      background: rgba(0, 0, 0, 0.75);
      border: 2px solid #ff00ea;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 0 15px 3px #ff00ea;
      text-align: left;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .anuncio-card:hover {
      transform: scale(1.02);
      box-shadow: 0 0 30px 6px #ff00ea;
    }

    .anuncio-card h2 {
      margin-top: 0;
      color: #ff00ea;
      font-size: 1.4em;
    }

    .anuncio-card p {
      margin: 10px 0 0;
      line-height: 1.4;
    }

    .anuncio-card.evento { border-color: #ff9800; box-shadow: 0 0 15px 3px #ff9800; }
    .anuncio-card.mantenimiento { border-color: #00bcd4; box-shadow: 0 0 15px 3px #00bcd4; }
    .anuncio-card.tienda { border-color: #4caf50; box-shadow: 0 0 15px 3px #4caf50; }
  </style>
</head>
<body>

  <nav class="navbar" role="navigation" aria-label="Menú principal">
    <button class="menu-toggle" onclick="toggleMenu()" id="menuToggle" aria-label="Menú de navegación" aria-expanded="false">
      <i class="fas fa-bars"></i>
    </button>

    <div class="navbar-left" id="navMenu">
      <a href="index.php" style="color:rgb(221, 11, 11)">Inicio</a>
      <a href="anuncios.php">ANUNCIOS</a>
      <a href="ruleta.php">RULETA</a>
      <a href="descargas.php">DESCARGAS</a>
      <a href="tienda.php">TIENDA</a>
      <a href="ranking.php">RANKING</a>
      <a href="codigos.php">CODIGOS</a>
      <a href="eliminar_personaje.php">ELIMINAR PERSONAJE</a>
      <a href="crear_clan.php">CREAR CLAN</a>
    </div>

    <div class="navbar-right" id="navRight">
      <div class="social-icons">
        <a href="https://chat.whatsapp.com/HdzheJXfD2SK1nWlOEarJw" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i></a>
        <a href="https://discord.gg/5275yAhgQ5" target="_blank" rel="noopener"><i class="fab fa-discord"></i></a>
      </div>

      <?php if (isset($_SESSION['usuario'])): ?>
        <span style="color: white; font-weight: bold;">
          Hola, <?= htmlspecialchars($_SESSION['usuario']) ?>
        </span>
        <button onclick="location.href='logout.php'">Cerrar sesión</button>
      <?php else: ?>
        <button onclick="location.href='formulario.php'">Regístrate</button>
        <button onclick="location.href='formulario.php'">Ingresar</button>
      <?php endif; ?>
    </div>
  </nav>

  <div class="contenido">
    <h1>ANUNCIOS</h1>

    <div class="anuncios-container">
      <div class="anuncio-card evento">
        <h2>🎉 Evento Doble XP</h2>
        <p>Desde el viernes 7 al domingo 9: ¡Gana el doble de experiencia en todas las zonas!</p>
      </div>

      <div class="anuncio-card mantenimiento">
        <h2>🛠️ Mantenimiento Programado</h2>
        <p>Miércoles 12 de junio a las 02:00 AM (GMT-3). Estimado de duración: 1 hora.</p>
      </div>

      <div class="anuncio-card tienda">
        <h2>🛍️ Nuevos Ítems en la Tienda</h2>
        <p>Disponible ahora: SkyBlazer, Black Panzer y nuevos sets especiales. ¡Revisa la tienda!</p>
      </div>
    </div>
  </div>

  <script>
    function toggleMenu() {
      const navMenu = document.getElementById('navMenu');
      const navRight = document.getElementById('navRight');
      const toggleIcon = document.getElementById('menuToggle').querySelector('i');
      const menuToggleButton = document.getElementById('menuToggle');

      navMenu.classList.toggle('active');
      navRight.classList.toggle('active');

      if (navMenu.classList.contains('active')) {
        toggleIcon.classList.remove('fa-bars');
        toggleIcon.classList.add('fa-times');
        menuToggleButton.setAttribute('aria-expanded', 'true');
      } else {
        toggleIcon.classList.remove('fa-times');
        toggleIcon.classList.add('fa-bars');
        menuToggleButton.setAttribute('aria-expanded', 'false');
      }
    }

    document.querySelectorAll('.navbar-left a').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
          document.getElementById('navMenu').classList.remove('active');
          document.getElementById('navRight').classList.remove('active');
          const icon = document.getElementById('menuToggle').querySelector('i');
          icon.classList.remove('fa-times');
          icon.classList.add('fa-bars');
          document.getElementById('menuToggle').setAttribute('aria-expanded', 'false');
        }
      });
    });
  </script>

</body>
</html>
