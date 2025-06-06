<?php
session_start();
include 'conexion.php';

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["usuario"]);
    $email = trim($_POST["email"]);
    $numero = trim($_POST["numero"]);
    $clave = $_POST["clave"];
    $confirmar_clave = $_POST["confirmar_clave"];

    if (empty($usuario) || empty($email) || empty($numero) || empty($clave) || empty($confirmar_clave)) {
        $mensaje = "Por favor completa todos los campos.";
    } elseif ($clave !== $confirmar_clave) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $mensaje = "El nombre de usuario ya está en uso.";
        } else {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO usuarios (usuario, email, numero, contrasena) VALUES (?, ?, ?, ?)");
            $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
            $stmt->bind_param("ssss", $usuario, $email, $numero, $clave_hash);

            if ($stmt->execute()) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                $mensaje = "Error al registrar el usuario.";
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
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

        .success {
            color: #00ff99;
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
    <h2>Registro de Usuario</h2>

    <?php if ($mensaje): ?>
        <div class="<?= strpos($mensaje, 'éxito') !== false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <form action="formulario.php" method="POST">
        <input type="text" name="usuario" placeholder="Nombre de usuario" required value="<?= isset($usuario) ? htmlspecialchars($usuario) : '' ?>">
        <input type="email" name="email" placeholder="Correo electrónico" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
        <input type="text" name="numero" placeholder="Número de teléfono" required value="<?= isset($numero) ? htmlspecialchars($numero) : '' ?>">
        <input type="password" name="clave" placeholder="Contraseña" required>
        <input type="password" name="confirmar_clave" placeholder="Confirmar contraseña" required>
        <button type="submit">Registrar</button>
    </form>

    <p><a href="login.php">¿Ya tienes cuenta? Inicia sesión</a></p>
</div>

</body>
</html>
