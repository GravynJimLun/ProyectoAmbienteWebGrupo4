<?php
session_start();
require_once("include/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $identificacion = trim($_POST['identificacion']);
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    
    if (empty($identificacion) || empty($nombre) || empty($apellidos) || empty($email) || empty($usuario)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Correo inválido.";
    } elseif ($password !== $confirm) {
        $error = "Las contraseñas no coinciden.";
    } else {
        
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

    
        $stmt = $mysqli->prepare("
            INSERT INTO clientes (identificacion, nombre, apellidos, email, usuario, contrasena)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssss", $identificacion, $nombre, $apellidos, $email, $usuario, $hash_pass);

        try {
            $stmt->execute();
            $success = "Usuario creado correctamente.";
        } catch (mysqli_sql_exception $e) {
            if ($mysqli->errno === 1062) { 
                $error = "El usuario, correo o identificación ya existe.";
            } else {
                $error = "Error al crear usuario: " . $e->getMessage();
            }
        }
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario - Proyecto Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg w-100" style="max-width: 600px">
        <div class="card-header text-center">
            <h3>Registro de Usuario</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST" id="registro">
                <div class="mb-3">
                    <label for="identificacion" class="form-label">Identificación:</label>
                    <input type="text" name="identificacion" id="identificacion" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefono_personal" class="form-label">Teléfono Personal:</label>
                     <input type="tel" name="telefono_personal" id="telefono_personal" class="form-control" required>
                </div>

                <div class="mb-3">
                     <label for="direccion_personal" class="form-label">Dirección Personal:</label>
                      <input type="text" name="direccion_personal" id="direccion_personal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="telefono_trabajo" class="form-label">Teléfono Trabajo:</label>
                     <input type="tel" name="telefono_trabajo" id="telefono_trabajo" class="form-control" required>
                </div>

                <div class="mb-3">
                     <label for="direccion_trabajo" class="form-label">Dirección Trabajo:</label>
                      <input type="text" name="direccion_trabajo" id="direccion_trabajo" class="form-control" required>
                </div>

                <div class="mb-3">
                     <label for="lugar_trabajo" class="form-label">Lugar de Trabajo:</label>
                      <input type="text" name="lugar_trabajo" id="lugar_trabajo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="confirm" class="form-label">Confirmar contraseña:</label>
                    <input type="password" name="confirm" id="confirm" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Registrar</button>
                <p class="text-center mt-3">
                    Si ya estás registrado <a href="login.php">Inicia sesión aquí</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
