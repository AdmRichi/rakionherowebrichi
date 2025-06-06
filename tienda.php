<?php
session_start();

// Puntos actuales del usuario (puedes obtenerlo de la sesión o base de datos)
$puntos_usuario = 15000;

// Items de la tienda
$items = [
    // Ítems exclusivos 
    ['img' => 'AnilloSweety.png', 'nombre' => 'Anillo Sweety', 'precio' => 6000],
    ['img' => 'CollarHonor.png', 'nombre' => 'Collar Honor', 'precio' => 6000],
    ['img' => 'Golem.png', 'nombre' => 'Golem', 'precio' => 6000],
    ['img' => 'LongBow.png', 'nombre' => 'Long Bow', 'precio' => 6000],
    ['img' => 'Dragon.png', 'nombre' => 'Dragon', 'precio' => 6000],
    ['img' => 'Taurus.png', 'nombre' => 'Taurus', 'precio' => 6000],
    ['img' => 'ex1.png', 'nombre' => 'Item Exclusivo 1', 'precio' => 6000],
    ['img' => 'ex2.png', 'nombre' => 'Item Exclusivo 2', 'precio' => 6000],
    ['img' => 'ex3.png', 'nombre' => 'Item Exclusivo 3', 'precio' => 6000],
    ['img' => 'ex4.png', 'nombre' => 'Item Exclusivo 4', 'precio' => 6000],
    ['img' => 'ex5.png', 'nombre' => 'Item Exclusivo 5', 'precio' => 6000],
    ['img' => 'ex6.png', 'nombre' => 'Item Exclusivo 6', 'precio' => 6000],
    ['img' => 'ex7.png', 'nombre' => 'Item Exclusivo 7', 'precio' => 6000],
    ['img' => 'ex8.png', 'nombre' => 'Item Exclusivo 8', 'precio' => 6000],
    ['img' => 'ex9.png', 'nombre' => 'Item Exclusivo 9', 'precio' => 6000],
    ['img' => 'ex10.png', 'nombre' => 'Item Exclusivo 10', 'precio' => 6000],
    ['img' => 'ex11.png', 'nombre' => 'Item Exclusivo 11', 'precio' => 6000],
    ['img' => 'ex12.png', 'nombre' => 'Item Exclusivo 12', 'precio' => 6000],
    ['img' => 'ex13.png', 'nombre' => 'Item Exclusivo 13', 'precio' => 6000],
    ['img' => 'ex14.png', 'nombre' => 'Item Exclusivo 14', 'precio' => 6000],
    ['img' => 'ex15.png', 'nombre' => 'Item Exclusivo 15', 'precio' => 6000],
    ['img' => 'ex16.png', 'nombre' => 'Item Exclusivo 16', 'precio' => 6000],
    ['img' => 'ex17.png', 'nombre' => 'Item Exclusivo 17', 'precio' => 6000],
    ['img' => 'ex18.png', 'nombre' => 'Item Exclusivo 18', 'precio' => 6000],
    ['img' => 'ex19.png', 'nombre' => 'Item Exclusivo 19', 'precio' => 6000],
    ['img' => 'ex20.png', 'nombre' => 'Item Exclusivo 20', 'precio' => 6000],
    ['img' => 'ex21.png', 'nombre' => 'Item Exclusivo 21', 'precio' => 6000],
    ['img' => 'ex22.png', 'nombre' => 'Item Exclusivo 22', 'precio' => 6000],
    ['img' => 'ex23.png', 'nombre' => 'Item Exclusivo 23', 'precio' => 6000],
    ['img' => 'ex24.png', 'nombre' => 'Item Exclusivo 24', 'precio' => 6000],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>TIENDA</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    .contenido {
      padding-top: 100px;
      max-width: 1200px;
      margin: 0 auto;
      color: white;
      text-align: center;
    }

    /* Título animado */
   h1 {
    font-size: 3.5rem;
    font-weight: 900;
    color: #ff0000;
    text-shadow:
    0 0 5px #ff0000,
    0 0 10px #ff0000,
    0 0 20px #ff0000,
    0 0 40px #ff0000;
    animation: glow 2.5s ease-in-out infinite alternate;
    margin-bottom: 30px;
  }


   @keyframes glow {
    from {
    text-shadow:
      0 0 5px #ff0000,
      0 0 10px #ff0000,
      0 0 20px #ff0000,
      0 0 40px #ff0000;
     color: #ff0000;
     }
     to {
     text-shadow:
      0 0 20px #ff0000,
      0 0 30px #ff0000,
      0 0 40px #ff0000,
      0 0 60px #ff0000;
     color: #ff4d4d;
     }
   }


    .puntos-usuario {
      font-size: 1.3em;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .grid-tienda {
      display: grid;
      grid-template-columns: repeat(6, 1fr);
      gap: 20px;
    }

     .item-tienda {
      background: rgba(0, 0, 0, 0.7);
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 0 10px #ff0000; /* borde rojo */
      transition: transform 0.3s ease;
    } 

    .item-tienda:hover {
      transform: scale(1.05);
    }

    .item-tienda img {
      max-width: 100%;
      height: auto;
      border-radius: 6px;
      margin-bottom: 10px;
    }

    .precio {
      font-size: 1.1em;
      margin-bottom: 10px;
      color:rgb(255, 0, 0);
      font-weight: bold;
    }

    .btn-comprar {
      background-color:rgb(255, 0, 0);
      color: white;
      border: none;
      padding: 8px 15px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-comprar:hover {
      background-color:rgb(255, 4, 4);
    }

    /* Responsive grid */
    @media(max-width: 1024px) {
      .grid-tienda {
        grid-template-columns: repeat(3, 1fr);
      }
    }
    @media(max-width: 600px) {
      .grid-tienda {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    @media(max-width: 400px) {
      .grid-tienda {
        grid-template-columns: 1fr;
      }
    }
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
        <a href="https://chat.whatsapp.com/HdzheJXfD2SK1nWlOEarJw" target="_blank"><i class="fab fa-whatsapp"></i></a>
        <a href="https://discord.gg/5275yAhgQ5" target="_blank"><i class="fab fa-discord"></i></a>
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
    <h1>TIENDA</h1>

    <div class="puntos-usuario">
      Tus puntos actuales: <?= number_format($puntos_usuario) ?>
    </div>

    <div class="grid-tienda">
      <?php foreach ($items as $item): ?>
        <div class="item-tienda">
          <img src="img/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['nombre']) ?>" />
          <div class="precio"><?= number_format($item['precio']) ?> puntos</div>
          <a href="comprar.php?item=<?= urlencode($item['nombre']) ?>" class="btn-comprar">Comprar</a>
        </div>
      <?php endforeach; ?>
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

      let expanded = menuToggleButton.getAttribute('aria-expanded') === 'true';
      menuToggleButton.setAttribute('aria-expanded', !expanded);

      // Cambiar icono del botón
      if (toggleIcon.classList.contains('fa-bars')) {
        toggleIcon.classList.remove('fa-bars');
        toggleIcon.classList.add('fa-times');
      } else {
        toggleIcon.classList.remove('fa-times');
        toggleIcon.classList.add('fa-bars');
      }
    }
  </script>

</body>
</html>
