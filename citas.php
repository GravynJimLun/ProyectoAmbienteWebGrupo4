<?php
require_once("include/conexion.php");

// Insertar cita
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $cliente  = $_POST['cliente'];
    $mascota  = $_POST['mascota'];
    $servicio = $_POST['servicio'];
    $precio   = $_POST['precio'];
    $fecha    = $_POST['fechaCita'];

    $sql = "INSERT INTO citas (nom_cliente, mascota, servicio, precio, fecha) 
            VALUES ('$cliente', '$mascota', '$servicio', '$precio', '$fecha')";

    if ($conexion->query($sql)) {
        $mensaje = "Cita registrada correctamente.";
    } else {
        $mensaje = "Error: " . $conexion->error;
    }
}

// Consultar todas las citas
$resultado = $conexion->query("SELECT * FROM citas ORDER BY fecha ASC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestión de Citas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.html">AgroEscazú</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="productos.html">Productos</a></li>
        <li class="nav-item"><a class="nav-link active" href="citas.php">Citas</a></li>
        <li class="nav-item"><a class="nav-link" href="admin.html">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="contacto.html">Contacto</a></li>
        <li class="nav-item"><a class="nav-link" href="calendario.html">Calendario</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>           
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h2>Gestión de Citas</h2>

  <?php if (!empty($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>

  <form method="POST" class="row g-3">
    <div class="col-md-3">
      <input type="text" class="form-control" name="cliente" placeholder="Nombre del cliente" required />
    </div>
    <div class="col-md-3">
      <input type="text" class="form-control" name="mascota" placeholder="Mascota" required />
    </div>
    <div class="col-md-3">
      <select class="form-select" name="servicio" required>
        <option value="">Seleccione un servicio</option>
        <option value="Consulta General">Consulta General</option>
        <option value="Vacunación">Vacunación</option>
        <option value="Desparasitación">Desparasitación</option>
        <option value="Grooming">Grooming</option>
        <option value="Cirugía menor">Cirugía menor</option>
      </select>
    </div>
    <div class="col-md-2">
      <input type="number" class="form-control" name="precio" placeholder="Precio" required />
    </div>
    <div class="col-md-3">
      <input type="datetime-local" class="form-control" name="fechaCita" required />
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-success">Registrar Cita</button>
    </div>
  </form>

  <hr />

  <table class="table table-striped mt-4">
    <thead class="table-dark">
      <tr>
        <th>Cliente</th>
        <th>Mascota</th>
        <th>Servicio</th>
        <th>Precio</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($cita = $resultado->fetch_assoc()) { ?>
        <tr>
          <td><?= htmlspecialchars($cita['nom_cliente']) ?></td>
          <td><?= htmlspecialchars($cita['mascota']) ?></td>
          <td><?= htmlspecialchars($cita['servicio']) ?></td>
          <td>₡<?= number_format($cita['precio'], 2) ?></td>
          <td><?= $cita['fecha'] ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<footer class="footer mt-auto py-3 bg-dark text-white text-center">
  <div class="container">
    <span>© 2025 Agroescazú | Clínica Veterinaria</span>
  </div>
</footer>

</body>
</html>
