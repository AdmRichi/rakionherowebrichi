<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Font Awesome para íconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  body {
    margin: 0;
    padding: 0;
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

  .navbar-right button {
    background-color: rgba(0, 0, 0, 0.6);
    color: white;
    border: 2px solid #f9f5f4;
    padding: 10px 16px;
    border-radius: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: 10px;
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
    }
  }
</style>

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
      <a href="https://chat.whatsapp.com/HdzheJXfD2SK1nWlOEarJw" target="_blank"><i class="fab fa-whatsapp"></i></a>
      <a href="https://discord.gg/5275yAhgQ5" target="_blank"><i class="fab fa-discord"></i></a>
    </div>

    <?php if (isset($_SESSION['usuario'])): ?>
    <span style="color: white; font-weight: bold;">
    Hola, <?= htmlspecialchars($_SESSION['usuario']) ?>
     </span>
    <button onclick="location.href='logout.php'">Cerrar sesión</button>
    <button onclick="location.href='soporte.php'">Soporte</button>
    <?php else: ?>
  <button onclick="location.href='formulario.php'">Regístrate</button>
  <button onclick="location.href='login.php'">Ingresar</button>
<?php endif; ?>
  </div>
</nav>

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

  document.querySelectorAll('#navMenu a').forEach(link => {
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

  window.addEventListener('DOMContentLoaded', () => {
    const navbarHeight = document.querySelector('.navbar').offsetHeight;
    document.body.style.marginTop = navbarHeight + 'px';
  });
</script>
