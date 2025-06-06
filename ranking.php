<?php
setlocale(LC_TIME, 'es_ES.UTF-8');
session_start();

// Ranking falso temporal para diseño
$ranking = [];
for ($i = 1; $i <= 50; $i++) {
    $ranking[] = [
        'clase' => 'class' . ($i % 5),
        'personaje' => 'Player' . $i,
        'nivel' => rand(10, 30),
        'winrate' => rand(40, 90) + rand(0, 99)/100,
        'victorias' => rand(20, 150),
        'derrotas' => rand(10, 70),
        'experiencia' => rand(20000, 70000),
    ];
}

// Paginación
$items_per_page = 20;
$total_items = count($ranking);
$total_pages = ceil($total_items / $items_per_page);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;

$start_index = ($page - 1) * $items_per_page;
$ranking_page = array_slice($ranking, $start_index, $items_per_page);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ranking de Jugadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('./img/fondo.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 1000px;
            margin: 80px auto 40px;
            background: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 40px 5px rgba(255, 215, 0, 0.9);
            animation: glow 2.5s ease-in-out infinite alternate;
        }

        @keyframes glow {
            0% { box-shadow: 0 0 15px 2px rgba(255, 215, 0, 0.6); }
            100% { box-shadow: 0 0 40px 5px rgba(255, 215, 0, 1); }
        }

        h1 {
            margin-bottom: 25px;
            color: #ffcc00;
            font-size: 2.2em;
            text-align: center;
            text-shadow: 0 0 10px #ffcc00;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #2a2a2a;
            border-radius: 12px;
            overflow: hidden;
            animation: fadeInUp 1s ease forwards;
            opacity: 0;
            transform: translateY(20px);
            min-width: 700px;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        table th, table td {
            padding: 12px 10px;
            text-align: center;
            vertical-align: middle;
            transition: all 0.3s ease;
            word-wrap: break-word;
        }

        table th {
            background-color: #3d0066;
            color: #ffb3f1;
            font-size: 0.9rem;
        }

        table tr:nth-child(even) {
            background-color: #1c1c1c;
        }

        table tr:hover {
            background-color: #292929;
            box-shadow: 0 0 15px 3px rgba(255, 215, 0, 0.8);
            transition: box-shadow 0.4s ease, background-color 0.3s ease;
        }

        .clase-img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            filter: drop-shadow(0 0 3px gold);
        }

        .pagination {
            margin-top: 30px;
            text-align: center;
            user-select: none;
        }

        .pagination a {
            color: #ffcc00;
            font-size: 2rem;
            margin: 0 15px;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .pagination a.disabled {
            color: #555;
            cursor: default;
        }

        .pagination a:hover:not(.disabled) {
            color: #fff066;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            main {
                margin: 30px 10px;
                padding: 20px;
            }

            h1 {
                font-size: 1.6em;
                margin-bottom: 15px;
            }

            table th, table td {
                padding: 8px 6px;
                font-size: 0.85rem;
            }

            .clase-img {
                width: 32px;
                height: 32px;
            }

            .pagination a {
                font-size: 1.4rem;
                margin: 0 8px;
            }
        }

        @media (max-width: 400px) {
            h1 {
                font-size: 1.3em;
            }

            .pagination a {
                font-size: 1.1rem;
                margin: 0 5px;
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h1>Ranking de Jugadores</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Clase</th>
                    <th>Personaje</th>
                    <th>Nivel</th>
                    <th>WinRate</th>
                    <th>Victorias</th>
                    <th>Derrotas</th>
                    <th>Experiencia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ranking_page as $index => $jugador): ?>
                    <tr>
                        <td><?= $start_index + $index + 1 ?></td>
                        <td>
                            <img 
                                class="clase-img" 
                                src="img/<?= htmlspecialchars($jugador['clase']) ?>.png" 
                                alt="<?= htmlspecialchars($jugador['clase']) ?>"
                                title="<?= htmlspecialchars($jugador['clase']) ?>"
                            />
                        </td>
                        <td><?= htmlspecialchars($jugador['personaje']) ?></td>
                        <td><?= $jugador['nivel'] ?></td>
                        <td><?= number_format($jugador['winrate'], 2) ?>%</td>
                        <td><?= $jugador['victorias'] ?></td>
                        <td><?= $jugador['derrotas'] ?></td>
                        <td><?= number_format($jugador['experiencia']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" title="Página anterior">◀</a>
        <?php else: ?>
            <a class="disabled">◀</a>
        <?php endif; ?>

        <span style="font-size: 1.2rem; color:#fff066;">Página <?= $page ?> de <?= $total_pages ?></span>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>" title="Página siguiente">▶</a>
        <?php else: ?>
            <a class="disabled">▶</a>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
