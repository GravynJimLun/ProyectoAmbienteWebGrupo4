<?php
session_start();
require_once("include/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario = $_POST['usuario']; // debe coincidir con el name del input del formulario
    $password = $_POST['password'];

    // Validar campos vacíos
    if (empty($usuario) || empty($password)) {
        $mensaje = "Por favor ingrese usuario y contraseña";
    } else {
        // Consulta correcta: tabla clientes y columnas de tu DB
        $stmt = $mysqli->prepare("SELECT id_cliente, nombre, contrasena FROM clientes WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $cliente = $resultado->fetch_assoc();

            if (password_verify($password, $cliente['contrasena'])) {
                $_SESSION['id_cliente'] = $cliente['id_cliente'];
                $_SESSION['nombre'] = $cliente['nombre'];
                $_SESSION['usuario'] = $usuario;
                header("Location: index.html");
                exit();
            } else {
                $mensaje = "Contraseña incorrecta";
            }
        } else {
            $mensaje = "Usuario no registrado";
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - AgroEscazú</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">AgroEscazú</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

  <div class="container mt-5 mb-3" style="max-width: 400px;">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>
    <form method="POST" action="index.html">
      <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
      <p class="text-center mt-3">¿No tienes cuenta? <a href="register.php">Registrarse aquí.</a></p>
    </form>

    <?php if (!empty($mensaje)): ?>
      <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($mensaje); ?></div>
    <?php endif; ?>
  </div>
  
  <footer class="footer mt-auto py-3 bg-dark text-white text-center">
    <div class="container">
      <span>© 2025 Agroescazú | Clínica Veterinaria</span>
    </div>
  </footer>

</body>
</html>
