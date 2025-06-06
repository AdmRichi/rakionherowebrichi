<?php
session_start();
include 'conexion.php'; // Asegúrate que $conn esté definido ahí

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave = $_POST['clave'] ?? '';

    if (empty($usuario) || empty($clave)) {
        $error = "Por favor completa ambos campos.";
    } else {
        $stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();

            if (password_verify($clave, $row['contrasena'])) {
                // Guardar nombre de usuario en la sesión
                $_SESSION['usuario'] = $usuario;
                header("Location: index.php");
                exit();
            } else {
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "No existe un usuario con ese nombre.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Iniciar Sesión</title>
    <style>
        body {
            background: url('img/fondo.png') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
            padding-top: 150px;
        }

        .form-box {
            background: rgba(0, 0, 0, 0.8);
            display: inline-block;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px #ff00ea;
        }

        input, button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
            border: none;
        }

        input {
            background-color: #f2f2f2;
            color: black;
        }

        button {
            background-color: #ff00ea;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #fff;
        }

        .error {
            color: #ff4444;
            margin-bottom: 15px;
        }

        a {
            color: #ff00ea;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)) { ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php } ?>

    <form action="login.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="clave" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>

    <p><a href="formulario.php">¿No tienes cuenta? Regístrate aquí</a></p>
</div>

</body>
</html>
