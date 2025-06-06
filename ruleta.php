<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ruleta Aleatoria</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: url('img/fondo.png') no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      color: white;
    }

    .ruleta-container {
      margin: 100px auto;
      padding: 20px;
      max-width: 400px;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 20px;
      box-shadow: 0 0 20px 4px #ff00ea;
      position: relative;
      z-index: 2;
      text-align: center;
    }

    canvas {
      margin: 20px auto;
      display: block;
      position: relative;
      z-index: 3;
    }

    .spark-effect {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
      pointer-events: none;
      z-index: 1;
      animation: spark 0.8s infinite ease-in-out;
      border-radius: 50%;
    }

    @keyframes spark {
      0% { opacity: 0.3; transform: translateX(-50%) scale(1); }
      50% { opacity: 0.6; transform: translateX(-50%) scale(1.05); }
      100% { opacity: 0.3; transform: translateX(-50%) scale(1); }
    }

    .botones-superiores {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 15px;
    }

    .boton-giro {
      background-color: #ff0033;
      color: white;
      font-weight: bold;
      padding: 10px 20px;
      border: 2px solid #ff4da6;
      border-radius: 10px;
      cursor: pointer;
      box-shadow: 0 0 10px #ff4da6, 0 0 20px #ff4da6;
      transition: transform 0.2s;
    }

    .boton-giro:hover {
      transform: scale(1.05);
      box-shadow: 0 0 15px #ff80bf, 0 0 25px #ff80bf;
    }

    .boton-centro {
      margin: 10px auto 0;
    }

    #resultado {
      font-size: 20px;
      margin-top: 15px;
    }

    #premio-img {
      max-width: 80%;
      margin: 10px auto 0;
      display: block;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="ruleta-container">
  <div class="spark-effect"></div>
  <h2>La Ruleta Aleatoria</h2>
  <canvas id="canvas" width="300" height="300"></canvas>

  <div class="botones-superiores">
    <button class="boton-giro" onclick="girar()">Usar Oro // 10000</button>
    <button class="boton-giro" onclick="girar()">Usar Cash // 1000</button>
  </div>
  <div class="boton-centro">
    <button class="boton-giro" onclick="girar()">Intento Gratis</button>
  </div>

  <div id="resultado"></div>
  <img id="premio-img" src="" alt="" style="display: none;">
</div>

<audio id="sonido">
  <source src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_06b6a3d7e7.mp3?filename=spin-wheel-104787.mp3" type="audio/mpeg">
</audio>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<script>
  const canvas = document.getElementById("canvas");
  const ctx = canvas.getContext("2d");
  const resultado = document.getElementById("resultado");
  const sonido = document.getElementById("sonido");
  const premioImg = document.getElementById("premio-img");

  const numeros = Array.from({ length: 12 }, (_, i) => i + 1);
  const colors = [
    "#f44336", "#ff9800", "#ffeb3b", "#8bc34a", "#00bcd4", "#3f51b5",
    "#9c27b0", "#e91e63", "#607d8b", "#4caf50", "#2196f3", "#ff5722"
  ];

  const premios = {
    1: { texto: "¡Ganaste Pu Card!", imagen: "img/PuCard.png" },
    2: { texto: "¡Ganaste Taurus!", imagen: "img/Taurus.png" },
    3: { texto: "¡Ganaste Reset Stats!", imagen: "img/resetstats.png" },
    4: { texto: "¡Ganaste un LongBow!", imagen: "img/Longbow.png" },
    5: { texto: "¡Ganaste un Musketeer!", imagen: "img/Musketeer.png" },
    6: { texto: "¡Ganaste un SkyBlazer!", imagen: "img/SkyBlazer.png" },
    7: { texto: "¡Ganaste un Dragon!", imagen: "img/Dragon.png" },
    8: { texto: "¡Ganaste un Collar Honor!", imagen: "img/CollarHonor.png" },
    9: { texto: "¡Ganaste un Collar Lovely!", imagen: "img/CollarLovely.png" },
    10: { texto: "¡Ganaste un Cambio de Raza!", imagen: "img/cambioraza.png" },
    11: { texto: "¡Ganaste un Black Panzer!", imagen: "img/BlackPanzer.png" },
    12: { texto: "¡Ganaste un Anillo Honor!", imagen: "img/AnilloHonor.png" }
  };

  let angle = 0;
  let spinning = false;

  function drawWheel() {
    const radius = 150;
    const center = canvas.width / 2;
    const arc = Math.PI * 2 / numeros.length;

    for (let i = 0; i < numeros.length; i++) {
      const start = angle + i * arc;
      const end = start + arc;

      ctx.beginPath();
      ctx.fillStyle = colors[i];
      ctx.moveTo(center, center);
      ctx.arc(center, center, radius, start, end);
      ctx.fill();

      ctx.save();
      ctx.translate(center, center);
      ctx.rotate(start + arc / 2);
      ctx.fillStyle = "#000";
      ctx.font = "bold 16px sans-serif";
      ctx.fillText(numeros[i], radius - 30, 10);
      ctx.restore();
    }

    // Flecha
    ctx.beginPath();
    ctx.fillStyle = "white";
    ctx.moveTo(center - 10, 10);
    ctx.lineTo(center + 10, 10);
    ctx.lineTo(center, 30);
    ctx.closePath();
    ctx.fill();
  }

  drawWheel();

  function girar() {
    if (spinning) return;
    spinning = true;
    sonido.play();

    let spin = Math.random() * 360 + 3600;
    let current = 0;
    const duration = 5000;
    const interval = 20;
    const steps = duration / interval;
    const increment = spin / steps;

    const spinInterval = setInterval(() => {
      current += increment;
      angle = (current * Math.PI / 180) % (Math.PI * 2);
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      drawWheel();
    }, interval);

    setTimeout(() => {
      clearInterval(spinInterval);
      spinning = false;

      let degrees = (current % 360 + 360) % 360;
      let index = Math.floor((360 - degrees + 15) % 360 / 30);
      let numero = numeros[index];

      const premio = premios[numero];
      resultado.textContent = premio ? premio.texto : `¡Salió el número: ${numero}!`;

      if (premio && premio.imagen) {
        premioImg.src = premio.imagen;
        premioImg.style.display = 'block';

        const durationConfetti = 3000;
        const end = Date.now() + durationConfetti;

        (function frame() {
          confetti({
            particleCount: 5,
            angle: 60,
            spread: 55,
            origin: { x: 0 },
            zIndex: 9999
          });
          confetti({
            particleCount: 5,
            angle: 120,
            spread: 55,
            origin: { x: 1 },
            zIndex: 9999
          });
          if (Date.now() < end) {
            requestAnimationFrame(frame);
          }
        })();
      } else {
        premioImg.style.display = 'none';
      }
    }, duration);
  }
</script>

</body>
</html>
