<?php

session_start();
// CSRF token único
$_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));

require_once __DIR__ . '/../../includes/app.php';
require_once __DIR__ . '/../../includes/config/database.php';
require_once FUNCIONES_URL;

$db = conectarDB();
$errores = [];
// Inicializar campos con valores string vacíos
$campos = array_fill_keys([
  'titulo','precio','descripcion','habitaciones','wc','estacionamiento','vendedores_id'
], '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger y sanear inputs
    foreach (array_keys($campos) as $key) {
        $campos[$key] = trim((string)($_POST['propiedad'][$key] ?? ''));
    }
    // Validaciones
    if ($campos['titulo'] === '') {
        $errores[] = 'El título es obligatorio.';
    }
    if (!is_numeric($campos['precio'])) {
        $errores[] = 'El precio debe ser un número.';
    }
    if (strlen($campos['descripcion']) < 50) {
        $errores[] = 'La descripción debe tener al menos 50 caracteres.';
    }
    $ranges = ['habitaciones'=>[1,9],'wc'=>[0,9],'estacionamiento'=>[0,9]];
    foreach ($ranges as $field => [$min,$max]) {
        if (!filter_var($campos[$field], FILTER_VALIDATE_INT, ['options'=>['min_range'=>$min,'max_range'=>$max]])) {
            $errores[] = "{$field} debe estar entre {$min} y {$max}.";
        }
    }
    if ($campos['vendedores_id'] === '') {
        $errores[] = 'Seleccione un vendedor.';
    }
    // Validación de imagen
    $imgError = $_FILES['imagen']['error'] ?? UPLOAD_ERR_NO_FILE;
    if ($imgError !== UPLOAD_ERR_NO_FILE) {
        $img = $_FILES['imagen'];
        $tipos = ['image/jpeg','image/png','image/webp'];
        $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        if ($img['error'] !== UPLOAD_ERR_OK) {
            $errores[] = 'Error al subir la imagen.';
        } elseif (!in_array($img['type'], $tipos, true)) {
            $errores[] = 'Formato de imagen inválido.';
        } elseif ($img['size'] > 2 * 1024 * 1024) {
            $errores[] = 'La imagen supera 2 MB.';
        } elseif (!in_array($ext, ['jpg','jpeg','png','webp'], true)) {
            $errores[] = 'Extensión de imagen no permitida.';
        }
    } else {
        $errores[] = 'La imagen es obligatoria.';
    }
    // Insertar si no hay errores
    if (empty($errores)) {
        // Escapar valores
        array_walk($campos, fn(&$v)=>$v = mysqli_real_escape_string($db, $v));
        // Subir imagen
        if (!is_dir(IMG_BASE_PATH)) mkdir(IMG_BASE_PATH, 0755, true);
        $nombreImg = uniqid('prop_', true) . ".{$ext}";
        move_uploaded_file($img['tmp_name'], IMG_BASE_PATH . '/' . $nombreImg);
        // Prepared statement
        $stmt = $db->prepare(
            'INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id, imagen)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)' 
        );
        $fecha = date('Y-m-d');
        $stmt->bind_param(
            'sssiissis',
            $campos['titulo'],
            $campos['precio'],
            $campos['descripcion'],
            (int)$campos['habitaciones'],
            (int)$campos['wc'],
            (int)$campos['estacionamiento'],
            $fecha,
            (int)$campos['vendedores_id'],
            $nombreImg
        );
        if ($stmt->execute()) {
            header('Location: index.php?resultado=1');
            exit;
        }
    }
}

incluir_template('header');
?>
<main class="contenedor seccion">
  <h1>Crear Propiedad</h1>
  <?php foreach ($errores as $err): ?>
    <div class="alerta error"><?= htmlspecialchars($err, ENT_QUOTES) ?></div>
  <?php endforeach; ?>
  <form method="POST" enctype="multipart/form-data" action="crear.php">
    <!-- Inputs con nombres y clases originales -->
  </form>
</main>
<?php
incluir_template('footer');
mysqli_close($db);