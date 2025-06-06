<?php
session_start();                        //  ¡No borres esta línea ni pongas espacios arriba!
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RkHero – No Barbones</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
/* ——————————————————  FONDO GENERAL  —————————————————— */
body{
  margin:0;
  font-family:Arial, sans-serif;
  color:#fff;
  min-height:100vh;
}
body::before{
  content:''; position:fixed; inset:0;
  background:url('./img/fondo.png') no-repeat center/cover;
  z-index:-1;
}

/* ——————————————————  HERO  —————————————————— */
.hero{margin-top:100px;text-align:center}
.hero .logo{width:500px}

/* ——————————————————  CUADROS DE RANKING  —————————————————— */
.contenedor-ranking{
  display:flex;justify-content:center;flex-wrap:wrap;
  gap:30px;margin:50px auto;max-width:1200px;padding:0 20px;
}
.cuadro-ranking{
  background:rgba(0,0,0,.8);
  padding:20px;border-radius:15px;box-shadow:0 0 15px red;
  width:500px;max-height:400px;overflow-y:auto;scrollbar-width:none;
}
.cuadro-ranking::-webkit-scrollbar{display:none}
.cuadro-ranking h2{margin:0 0 15px;text-align:center;font-size:28px}
table{width:100%;border-collapse:collapse;color:#fff}
th,td{padding:10px;text-align:left}
th{background:#222;position:sticky;top:0}
tr:nth-child(even){background:rgba(255,255,255,.05)}
.icono-clan{width:30px;height:30px}

/* ——————————————————  SECCIÓN ADMINISTRADORES  —————————————————— */
.administradores{
  max-width:1200px;margin:60px auto 80px;padding:0 20px;text-align:center
}
.administradores h2 {
  font-size: 36px;
  margin-bottom: 40px;
  text-transform: uppercase;
  letter-spacing: 4px;
  color: #ff4444; /* rojo vibrante */
  font-weight: 900;
  animation: slideInLeft 1s ease forwards; /* animación nueva */
}

.admin-cards-container{
  display:flex;justify-content:center;gap:40px;flex-wrap:wrap
}
.admin-card{
  background:rgba(0,0,0,.8);border-radius:15px;padding:30px 20px 40px;
  width:220px;text-align:center;opacity:0;transform:translateY(20px);
  animation:fadeUp .8s ease forwards;
  transition:box-shadow .3s ease
}
.admin-card img{
  width:140px;height:140px;object-fit:contain;margin-bottom:18px;border-radius:50%
}
.admin-name{
  margin:0;font-weight:900;font-size:22px;text-transform:uppercase;letter-spacing:1.5px;
  animation:pulseGlow 2.5s ease-in-out infinite
}

/* —— colores individuales para nombre y marco —— */
.naranja {
  color:#ff9800; text-shadow:0 0 8px #ff9800;
}
.cyan {
  color:#00bcd4; text-shadow:0 0 8px #00bcd4;
}
.verde {
  color:#4caf50; text-shadow:0 0 8px #4caf50;
}

/* —— sombras brillantes por color —— */
.admin-card.naranja {
  box-shadow:0 0 15px #ff9800;
}
.admin-card.naranja:hover {
  box-shadow:0 0 35px #ff9800;
}
.admin-card.cyan {
  box-shadow:0 0 15px #00bcd4;
}
.admin-card.cyan:hover {
  box-shadow:0 0 35px #00bcd4;
}
.admin-card.verde {
  box-shadow:0 0 15px #4caf50;
}
.admin-card.verde:hover {
  box-shadow:0 0 35px #4caf50;
}

/* ——— Animaciones en cascada ——— */
.admin-card:nth-child(1){animation-delay:.2s}
.admin-card:nth-child(2){animation-delay:.4s}
.admin-card:nth-child(3){animation-delay:.6s}

/* ——— keyframes ——— */
@keyframes fadeUp{to{opacity:1;transform:translateY(0)}}
@keyframes fadeInDown{from{opacity:0;transform:translateY(-20px)}to{opacity:1;transform:none}}
@keyframes pulseGlow{
  0%,100%{text-shadow:0 0 10px currentColor,0 0 20px currentColor}
  50%    {text-shadow:0 0 20px currentColor,0 0 40px currentColor}
}
@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-100px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* ——————————————————  SECCIÓN PROGRAMADORES  —————————————————— */
.programadores {
  max-width: 1200px;
  margin: 40px auto 80px;
  padding: 0 20px;
  text-align: center;
}
.programadores h2 {
  font-size: 36px;
  margin-bottom: 40px;
  text-transform: uppercase;
  letter-spacing: 4px;
  color:rgb(105, 196, 222); /* azul vibrante */
  font-weight: 900;
  animation: slideInLeft 1s ease forwards; /* animación nueva */
}


.programador-cards-container {
  display: flex;
  justify-content: center;
}

.programador-card {
  position: relative;
  background: rgba(0, 0, 0, 0.8);
  border-radius: 15px;
  padding: 30px 20px 40px;
  width: 220px;
  text-align: center;
  animation: fadeUp 0.8s ease forwards;
  box-shadow: 0 0 15px #66ffff;
  overflow: hidden; /* Para que no se salga el efecto */
  transition: box-shadow 0.3s ease;
  border: 2px solid #66ffff;
  z-index: 0;
}

/* Capa de escarcha */
.programador-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background:
    radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.15) 2px, transparent 3px),
    radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1) 2px, transparent 3px),
    radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.12) 3px, transparent 4px);
  background-repeat: repeat;
  background-size: 40px 40px;
  pointer-events: none;
  animation: escarchaMover 8s linear infinite;
  border-radius: 15px;
  mix-blend-mode: screen;
  z-index: 1;
}

/* Capa de brillo cristalino */
.programador-card::after {
  content: '';
  position: absolute;
  top: -40%;
  left: -30%;
  width: 160%;
  height: 160%;
  background:
    linear-gradient(45deg, rgba(255, 255, 255, 0.12) 25%, transparent 50%),
    linear-gradient(-45deg, rgba(255, 255, 255, 0.12) 25%, transparent 50%);
  background-size: 40% 40%;
  background-repeat: repeat;
  filter: blur(4px);
  opacity: 0.4;
  animation: brilloCristal 6s linear infinite;
  border-radius: 15px;
  pointer-events: none;
  mix-blend-mode: screen;
  z-index: 2;
}

/* Animación que mueve la escarcha */
@keyframes escarchaMover {
  0% {
    background-position: 0 0, 0 0, 0 0;
  }
  100% {
    background-position: 40px 40px, 40px 40px, 40px 40px;
  }
}

/* Animación para el brillo cristal */
@keyframes brilloCristal {
  0% {
    background-position: 0% 0%, 0% 0%;
  }
  100% {
    background-position: 100% 100%, 100% 100%;
  }
}

.programador-card:hover {
  box-shadow: 0 0 35px #66ffff;
  cursor: pointer;
}

.programador-card img {
  width: 140px;
  height: 140px;
  object-fit: contain;
  margin-bottom: 18px;
  border-radius: 50%;
  border: 2px solid #66ffff;
  box-shadow: 0 0 15px #66ffff;
  position: relative;
  z-index: 3;
}

.programador-name {
  margin: 0;
  font-weight: 900;
  font-size: 22px;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  text-shadow: 0 0 10px #66ffff;
  color: #66ffff;
  animation: pulseGlow 2.5s ease-in-out infinite;
  position: relative;
  z-index: 3;
}


  </style>
</head>
<body>

<?php include 'header.php'; ?>

<main>
  <!-- LOGO PRINCIPAL -->
  <div class="hero">
    <img src="img/LogoRakionHero.png" alt="Rakion Hero Logo" class="logo">
  </div>

  <!-- RANKINGS -->
  <div class="contenedor-ranking">
    <!-- Ranking Mensual -->
    <div class="cuadro-ranking">
      <h2>Ranking General</h2>
      <table>
        <thead><tr><th>Rank</th><th>Nombre</th><th>Puntos</th></tr></thead>
        <tbody>
          <tr><td>1</td><td>Jugador1</td><td>1500</td></tr>
          <tr><td>2</td><td>Jugador2</td><td>1400</td></tr>
          <tr><td>3</td><td>Jugador3</td><td>1300</td></tr>
          <tr><td>4</td><td>Jugador4</td><td>1250</td></tr>
          <tr><td>5</td><td>Jugador5</td><td>1200</td></tr>
          <tr><td>6</td><td>Jugador6</td><td>1100</td></tr>
          <tr><td>7</td><td>Jugador7</td><td>1000</td></tr>
          <tr><td>8</td><td>Jugador8</td><td>950</td></tr>
          <tr><td>9</td><td>Jugador9</td><td>900</td></tr>
          <tr><td>10</td><td>Jugador10</td><td>850</td></tr>
        </tbody>
      </table>
    </div>

    <!-- Ranking Clanes -->
    <div class="cuadro-ranking">
      <h2>Ranking de Clanes</h2>
      <table>
        <thead><tr><th>Rank</th><th>Icono</th><th>Clan</th></tr></thead>
        <tbody>
          <tr><td>1</td><td><img src="img/icono1.png" class="icono-clan"></td><td>Clan Fénix</td></tr>
          <tr><td>2</td><td><img src="img/icono2.png" class="icono-clan"></td><td>Clan Dragón</td></tr>
          <tr><td>3</td><td><img src="img/icono3.png" class="icono-clan"></td><td>Clan Oscuro</td></tr>
          <tr><td>4</td><td><img src="img/icono1.png" class="icono-clan"></td><td>Clan Trueno</td></tr>
          <tr><td>5</td><td><img src="img/icono2.png" class="icono-clan"></td><td>Clan Sombra</td></tr>
          <tr><td>6</td><td><img src="img/icono3.png" class="icono-clan"></td><td>Clan Eclipse</td></tr>
          <tr><td>7</td><td><img src="img/icono1.png" class="icono-clan"></td><td>Clan Centella</td></tr>
          <tr><td>8</td><td><img src="img/icono2.png" class="icono-clan"></td><td>Clan Volcán</td></tr>
          <tr><td>9</td><td><img src="img/icono3.png" class="icono-clan"></td><td>Clan Bestia</td></tr>
          <tr><td>10</td><td><img src="img/icono1.png" class="icono-clan"></td><td>Clan Caos</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- ADMINISTRADORES -->
  <section class="administradores">
    <h2>Administradores</h2>

    <div class="admin-cards-container">
      <div class="admin-card naranja">
        <img src="img/admin1.png" alt="Admin 1">
        <p class="admin-name naranja">Explicito</p>
      </div>

      <div class="admin-card cyan">
        <img src="img/admin2.png" alt="Admin 2">
        <p class="admin-name cyan">NeganGames</p>
      </div>

      <div class="admin-card verde">
        <img src="img/admin3.png" alt="Admin 3">
        <p class="admin-name verde">CorveS</p>
      </div>
    </div>
  </section>
   <!-- PROGRAMADORES -->
  <section class="programadores">
    <h2>Programador</h2>
    <div class="programador-cards-container">
      <div class="programador-card">
        <img src="img/programador1.png" alt="Programador 1">
        <p class="programador-name rosado">TikTokRichi</p>
      </div>
    </div>
  </section>
</main>
<!-- FOOTER PERSONALIZADO -->
<footer style="background-color: black; padding: 60px 20px 20px; text-align: center; color: white;">

  <div style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; margin-bottom: 40px;">
    <!-- Tarjeta WhatsApp -->
    <a href="https://chat.whatsapp.com/HdzheJXfD2SK1nWlOEarJw" target="_blank" style="text-decoration: none;">
      <div style="background-color: #111; padding: 30px; border-radius: 10px; width: 180px; transition: transform 0.3s;">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" style="width: 60px; margin-bottom: 15px;">
        <div style="font-size: 18px; font-weight: bold; color: white;">Whatsapp</div>
      </div>
    </a>

    <!-- Tarjeta Discord -->
    <a href="https://discord.com/invite/5275yAhgQ5" target="_blank" style="text-decoration: none;">
      <div style="background-color: #111; padding: 30px; border-radius: 10px; width: 180px; transition: transform 0.3s;">
        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111370.png" alt="Discord" style="width: 60px; margin-bottom: 15px;">
        <div style="font-size: 18px; font-weight: bold; color: white;">Discord</div>
      </div>
    </a>
  </div>

<!-- COPYRIGHT -->
<div style="font-size: 14px;">
  Copyright © 2025, Todos los derechos reservados a 
  <a href="aviso_legal.html" style="color: #ff4d4d; font-weight: bold; text-decoration: none;">
    Rakion hero
  </a>
</div>
</footer>

</body>
</html>