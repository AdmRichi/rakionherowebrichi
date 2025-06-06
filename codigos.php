<?php
setlocale(LC_TIME, 'es_ES.UTF-8');
session_start();

$mensaje = "";
$codigosReclamados = [];

function formatearFecha($fechaRaw) {
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $timestamp = strtotime($fechaRaw);
    return strftime('%e de %B de %Y, %H:%M', $timestamp);
}

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $conn = new mysqli("localhost", "root", "", "rakionherousuarios");

    if ($conn->connect_error) {
        $mensaje = "Error de conexión: " . $conn->connect_error;
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['codigo'])) {
            $codigoIngresado = trim($_POST['codigo']);

            $stmt = $conn->prepare("SELECT * FROM codigos WHERE codigo = ?");
            $stmt->bind_param("s", $codigoIngresado);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                if ($fila['usado']) {
                    $mensaje = "❌ Este código ya fue usado.";
                } else {
                    $update = $conn->prepare("UPDATE codigos SET usado = 1, usuario_usado = ?, fecha_usado = CURRENT_TIMESTAMP WHERE codigo = ?");
                    $update->bind_param("ss", $usuario, $codigoIngresado);
                    $update->execute();
                    $mensaje = "✅ ¡Código reclamado exitosamente!";
                }
            } else {
                $mensaje = "❌ El código ingresado no es válido.";
            }

            $stmt->close();
        }

        $historialStmt = $conn->prepare("SELECT codigo, fecha_usado FROM codigos WHERE usuario_usado = ?");
        $historialStmt->bind_param("s", $usuario);
        $historialStmt->execute();
        $resultHistorial = $historialStmt->get_result();

        while ($row = $resultHistorial->fetch_assoc()) {
            $codigosReclamados[] = [
                'codigo' => $row['codigo'],
                'fecha' => formatearFecha($row['fecha_usado'])
            ];
        }

        $historialStmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Códigos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
    background: url('./img/fondo.png') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Poppins', sans-serif;
    color: #fff;
    margin: 0;
    padding: 0;
}

main {
    width: 95%;
    max-width: 800px;
    margin: 30px auto;
    background: rgba(0, 0, 0, 0.85);
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 0 25px rgba(255, 59, 59, 0.5);
}

h1 {
    margin-bottom: 25px;
    color: #ff3b3b;
    font-size: 2em;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

form input[type="text"] {
    padding: 15px;
    width: 100%;
    border: none;
    border-radius: 10px;
    font-size: 1em;
}

form button {
    background: #ff3b3b;
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    transition: background 0.3s ease;
    width: 100%;
}

form button:hover {
    background: #cc0000;
}

.mensaje {
    margin-top: 20px;
    font-size: 1em;
    background: #1c1c1c;
    padding: 15px;
    border-left: 6px solid #ff3b3b;
    border-radius: 8px;
}

.historial {
    margin-top: 40px;
}

.historial h2 {
    color: #ff3b3b;
    font-size: 1.5em;
    margin-bottom: 15px;
    text-align: center;
}

.tabla-scroll {
    overflow-x: auto;
}

table {
    width: 100%;
    min-width: 400px;
    border-collapse: collapse;
    background-color: #2a2a2a;
    border-radius: 12px;
    overflow: hidden;
}

table th, table td {
    padding: 12px;
    text-align: center;
}

table th {
    background-color: #660000;
    color: #ffd1d1;
}

table tr:nth-child(even) {
    background-color: #1c1c1c;
}

table tr:hover {
    background-color: #292929;
}

@media (max-width: 500px) {
    h1 {
        font-size: 1.6em;
    }

    .mensaje {
        font-size: 0.95em;
    }

    table th, table td {
        font-size: 0.8em;
        padding: 8px;
    }
}
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes popIn {
    0% {
        opacity: 0;
        transform: scale(0.95);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes pulseRow {
    0% {
        background-color: #1c1c1c;
    }
    50% {
        background-color: #292929;
    }
    100% {
        background-color: #1c1c1c;
    }
}

/* Aplicamos las animaciones */
main {
    animation: fadeInUp 0.8s ease-out;
}

h1 {
    animation: popIn 0.6s ease;
}

form, .mensaje, .historial {
    animation: fadeInUp 0.8s ease-out;
    animation-delay: 0.2s;
    animation-fill-mode: both;
}

table tr:hover {
    animation: pulseRow 0.5s ease-in-out;
}
form button {
    background: #ff0000;
    padding: 15px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
    width: 100%;
}

form button:hover {
    background: #cc0000;
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(255, 0, 0, 0.5);
}

    </style>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
var count = 200;
var defaults = { origin: { y: 0.7 } };
function fire(particleRatio, opts) {
  confetti({ ...defaults, ...opts, particleCount: Math.floor(count * particleRatio) });
}
function lanzarConfeti() {
  fire(0.25, { spread: 26, startVelocity: 55 });
  fire(0.2, { spread: 60 });
  fire(0.35, { spread: 100, decay: 0.91, scalar: 0.8 });
  fire(0.1, { spread: 120, startVelocity: 25, decay: 0.92, scalar: 1.2 });
  fire(0.1, { spread: 120, startVelocity: 45 });
}
<?php if (strpos($mensaje, '✅') !== false): ?>
window.addEventListener('load', () => { lanzarConfeti(); });
<?php endif; ?>
</script>

</head>
<script>
var count = 200;
var defaults = {
  origin: { y: 0.7 }
};

function fire(particleRatio, opts) {
  confetti({
    ...defaults,
    ...opts,
    particleCount: Math.floor(count * particleRatio)
  });
}
<script>
<?php if (strpos($mensaje, '✅') !== false): ?>
  // Esperamos un poco a que cargue todo y lanzamos confeti
  window.addEventListener('load', () => {
    lanzarConfeti();
  });
<?php endif; ?>
</script>

</script>

<body>

<?php include 'header.php'; ?>

<main>
    <h1>Reclamar Código</h1>

    <?php if (isset($_SESSION['usuario'])): ?>
        <form method="post">
            <input type="text" name="codigo" placeholder="Escribe tu código aquí" required />
            <button type="submit">Reclamar</button>
        </form>

        <?php if (!empty($mensaje)): ?>
            <div class="mensaje"><?= htmlspecialchars($mensaje) ?></div>
        <?php endif; ?>

        <?php if (!empty($codigosReclamados)): ?>
            <div class="historial">
                <h2>Tus códigos reclamados:</h2>
                <div class="tabla-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Fecha de uso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($codigosReclamados as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['codigo']) ?></td>
                                    <td><?= htmlspecialchars($item['fecha']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p style="text-align: center;">Por favor, inicia sesión para ingresar un código.</p>
    <?php endif; ?>
</main>

</body>
</html>
