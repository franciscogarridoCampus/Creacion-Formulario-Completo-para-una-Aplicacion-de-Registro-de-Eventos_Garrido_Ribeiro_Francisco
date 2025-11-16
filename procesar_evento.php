<?php
function limpiar($v) {
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

// Validación básica en servidor
$errores = [];

if (empty($_POST['email'])) $errores[] = "El email es obligatorio.";
if (empty($_POST['password'])) $errores[] = "La contraseña es obligatoria.";
if ($_POST['password'] !== $_POST['password2']) $errores[] = "Las contraseñas no coinciden.";
if (!isset($_POST['terminos'])) $errores[] = "Debe aceptar los términos y condiciones.";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos Recibidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">

<?php if ($errores): ?>
    <div class="alert alert-danger">
        <h4>Errores encontrados:</h4>
        <ul>
            <?php foreach ($errores as $e) echo "<li>$e</li>"; ?>
        </ul>
    </div>
    <a href="index.html" class="btn btn-secondary">Volver</a>

<?php else: ?>
    <div class="card">
        <div class="card-header">Registro completado</div>
        <div class="card-body">

            <h5>Información Personal</h5>
            <p><strong>Nombre:</strong> <?= limpiar($_POST['nombre']) ?></p>
            <p><strong>Email:</strong> <?= limpiar($_POST['email']) ?></p>
            <p><strong>Teléfono:</strong> <?= limpiar($_POST['telefono']) ?></p>
            <p><strong>Fecha de nacimiento:</strong> <?= limpiar($_POST['nacimiento']) ?></p>
            <p><strong>Género:</strong> <?= limpiar($_POST['genero']) ?></p>

            <h5 class="mt-4">Evento</h5>
            <p><strong>Fecha del evento:</strong> <?= limpiar($_POST['fecha_evento']) ?></p>
            <p><strong>Entrada:</strong> <?= limpiar($_POST['tipo_entrada']) ?></p>
            <strong>Preferencias de comida:</strong>
            <ul>
                <?php
                if (isset($_POST['comida']))
                    foreach ($_POST['comida'] as $c) echo "<li>" . limpiar($c) . "</li>";
                ?>
            </ul>

            <h5 class="mt-4">Acceso</h5>
            <p><strong>Usuario:</strong> <?= limpiar($_POST['usuario']) ?></p>

            <h5 class="mt-4">Preferencias</h5>
            <p><strong>Notificaciones:</strong>
                <?= isset($_POST['notificaciones']) ? "Sí" : "No" ?>
            </p>

            <h5 class="mt-4">Encuesta</h5>
            <p><strong>Calificación:</strong> <?= limpiar($_POST['calificacion']) ?></p>
            <p><strong>Comentarios:</strong> <?= nl2br(limpiar($_POST['comentarios'])) ?></p>

            <h5 class="mt-4">Archivo</h5>
            <?php if ($_FILES['archivo']['name']): ?>
                <p><strong>Archivo subido:</strong> <?= limpiar($_FILES['archivo']['name']) ?></p>
            <?php else: ?>
                <p>No se subió archivo.</p>
            <?php endif; ?>

        </div>
    </div>

<?php endif; ?>

</div>
</body>
</html>
