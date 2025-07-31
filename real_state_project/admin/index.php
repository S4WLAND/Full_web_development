
<?php
session_start();
// Generar CSRF token único por sesión (nullsafe assignment)
$_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));

require_once __DIR__ . '/../includes/app.php';
require_once __DIR__ . '/../includes/config/database.php';
require_once FUNCIONES_URL;

// Conexión a la base de datos
$db = conectarDB();
// Obtener parámetro flash validado como entero
$resultado = filter_input(INPUT_GET, 'resultado', FILTER_VALIDATE_INT) ?? 0;
// Consulta de propiedades
$sql    = 'SELECT id, titulo, imagen, precio FROM propiedades';
$result = mysqli_query($db, $sql);

incluir_template('header');
?>
<main class="contenedor seccion">
  <h1>Administrador de Bienes Raíces</h1>

  <!-- Mensajes flash usando match expression de PHP 8 -->
  <?php
  $mensaje = match($resultado) {
      1 => 'Anuncio creado correctamente',
      2 => 'Anuncio actualizado correctamente',
      3 => 'Anuncio eliminado correctamente',
      default => ''
  };
  if ($mensaje !== ''): ?>
    <p class="alerta exito"><?= htmlspecialchars($mensaje, ENT_QUOTES) ?></p>
  <?php endif; ?>

  <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

  <table class="propiedades">
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($prop = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= htmlspecialchars((string)($prop['id'] ?? ''), ENT_QUOTES) ?></td>
        <td><?= htmlspecialchars((string)($prop['titulo'] ?? ''), ENT_QUOTES) ?></td>
        <td>
          <?php if (!empty($prop['imagen'])): ?>
            <img
              src="<?= IMG_BASE_URL . htmlspecialchars((string)($prop['imagen'] ?? ''), ENT_QUOTES) ?>"
              alt="Imagen <?= htmlspecialchars((string)($prop['titulo'] ?? ''), ENT_QUOTES) ?>"
              class="imagen-tabla">
          <?php else: ?>
            <div class="imagen-placeholder">
              <span class="placeholder-icon">📷</span>
              <span class="placeholder-text">Sin imagen</span>
            </div>
          <?php endif; ?>
        </td>
        <td>$<?= number_format((float)($prop['precio'] ?? 0.0), 0, ',', '.') ?></td>
        <td class="acciones">
          <!-- Botones de acción con CSRF token -->
          <div class="contenedor-botones">
              <form method="POST" action="/admin/propiedades/borrar.php">
                  <input type="hidden" name="id" value="<?= htmlspecialchars((string)($prop['id'] ?? ''), ENT_QUOTES) ?>">
                  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES) ?>">
                  <button type="submit" class="boton-rojo-block">Eliminar</button>
              </form>
              <a href="/admin/propiedades/actualizar.php?id=<?= urlencode((string)($prop['id'] ?? '')) ?>" class="boton-amarillo-block">Actualizar</a>
          </div>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>
<?php
incluir_template('footer');
mysqli_close($db);
?>