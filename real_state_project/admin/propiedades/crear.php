<?php

// Cargar configuración global (constantes de rutas, URLs, etc.)
require __DIR__ . '/../../includes/app.php';

// Conexión a la base de datos y funciones de plantilla
require __DIR__ . '/../../includes/config/database.php';
require FUNCIONES_URL;

$db = conectarDB();

// Consultar y preparar vendedores
$vendedores = [];
$res = mysqli_query($db, "SELECT id, nombre, apellido FROM vendedores");
while ($fila = mysqli_fetch_assoc($res)) {
    $vendedores[] = $fila;
}

// Inicializar errores y valores por defecto
$errores = [];
$campos = [
    'titulo'          => '',
    'precio'          => '',
    'descripcion'     => '',
    'habitaciones'    => '',
    'wc'              => '',
    'estacionamiento' => '',
    'vendedores_id'   => '',
    'imagen'          => ''
];

// Reglas de validación para campos del formulario
$rules = [
    'titulo' => [
        'required' => "El título es obligatorio",
        'maxlen'   => [255, "El título no puede exceder 255 caracteres"]
    ],
    'precio' => [
        'required' => "El precio es obligatorio",
        'numeric'  => "El precio debe ser un número válido",
        'min'      => [0, "El precio no puede ser negativo"]
    ],
    'descripcion' => [
        'required'=> "La descripción es obligatoria",
        'minlen'  => [50, "La descripción debe tener al menos 50 caracteres"]
    ],
    'habitaciones' => [
        'required'=> "El número de habitaciones es obligatorio",
        'integer' => "El número debe ser un entero",
        'range'   => [[1,9], "Las habitaciones deben estar entre 1 y 9"]
    ],
    'wc' => [
        'required'=> "El número de baños es obligatorio",
        'integer' => "El número debe ser un entero",
        'range'   => [[0,9], "Los baños deben estar entre 0 y 9"]
    ],
    'estacionamiento' => [
        'required'=> "El número de estacionamientos es obligatorio",
        'integer' => "El número debe ser un entero",
        'range'   => [[0,9], "Los estacionamientos deben estar entre 0 y 9"]
    ],
    'vendedores_id' => [
        'required'=> "Elige un vendedor",
        'in_array'=> [array_column($vendedores,'id'), "Vendedor inválido"]
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger y sanear datos de texto
    $props = $_POST['propiedad'] ?? [];
    foreach ($rules as $campo => $ruleSet) {
        $raw   = $props[$campo] ?? '';
        $value = trim($raw);
        $value = mysqli_real_escape_string($db, $value);
        $campos[$campo] = $value;

        // Validaciones genéricas
        if (isset($ruleSet['required']) && $value === '') {
            $errores[] = $ruleSet['required'];
            continue;
        }
        if (isset($ruleSet['minlen']) && strlen($value) < $ruleSet['minlen'][0]) {
            $errores[] = $ruleSet['minlen'][1];
        }
        if (isset($ruleSet['maxlen']) && strlen($value) > $ruleSet['maxlen'][0]) {
            $errores[] = $ruleSet['maxlen'][1];
        }
        if (isset($ruleSet['numeric']) && !is_numeric($value)) {
            $errores[] = $ruleSet['numeric'];
        }
        if (isset($ruleSet['integer']) && filter_var($value, FILTER_VALIDATE_INT) === false) {
            $errores[] = $ruleSet['integer'];
        }
        if (isset($ruleSet['range'])) {
            list($range, $msg) = $ruleSet['range'];
            if (!is_numeric($value) || $value < $range[0] || $value > $range[1]) {
                $errores[] = $msg;
            }
        }
        if (isset($ruleSet['in_array'])) {
            list($haystack, $msg) = $ruleSet['in_array'];
            if (!in_array($value, $haystack, true)) {
                $errores[] = $msg;
            }
        }
    }

    // Validación de la imagen (ahora opcional)
    $imageName = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
        $img = $_FILES['imagen'];
        if ($img['error'] !== UPLOAD_ERR_OK) {
            $errores[] = 'Error al subir la imagen.';
        } else {
            $allowed = ['image/jpeg','image/png'];
            if (!in_array($img['type'], $allowed, true)) {
                $errores[] = 'Solo se permiten JPG o PNG.';
            }
            if ($img['size'] > 2*1024*1024) {
                $errores[] = 'La imagen no puede superar 2MB.';
            }
            $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg','jpeg','png'], true)) {
                $errores[] = 'Extensión inválida.';
            }
            
            // Si no hay errores de imagen, preparar para subir
            if (empty($errores)) {
                // Asegurar directorio de imágenes
                if (!is_dir(IMG_BASE_PATH)) {
                    mkdir(IMG_BASE_PATH, 0755, true);
                }
                // Generar nombre único
                $imageName = uniqid('prop_', true) . ".{$ext}";
            }
        }
    }

    // Si pasa validación: subir imagen (si existe) y guardar registro
    if (empty($errores)) {
        // Subir imagen si se proporcionó
        if ($imageName) {
            move_uploaded_file($img['tmp_name'], IMG_BASE_PATH . '/' . $imageName);
            $campos['imagen'] = mysqli_real_escape_string($db, $imageName);
        } else {
            $campos['imagen'] = ''; // Imagen vacía si no se proporcionó
        }

        // Construir e insertar en BD
        $campos['creado'] = date('Y/m/d');
        $cols   = implode(', ', array_keys($campos));
        $vals   = "'" . implode("', '", array_values($campos)) . "'";
        $sql    = "INSERT INTO propiedades ($cols) VALUES ($vals)";
        if (mysqli_query($db, $sql)) {
            header('Location: /admin?resultado=1');
            exit;
        }
        $errores[] = 'Error al guardar en la base de datos.';
    }
}

// Renderizar template
incluir_template('header');
?>
<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $e): ?>
        <div class="alerta error"><?= htmlspecialchars($e); ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data" action="/admin/propiedades/crear.php">
        <!-- Información General -->
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="propiedad[titulo]" value="<?= htmlspecialchars($campos['titulo']); ?>">
            <label for="precio">Precio</label>
            <input type="number" id="precio" name="propiedad[precio]" value="<?= htmlspecialchars($campos['precio']); ?>">
            <label for="imagen">Imagen (opcional)</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="propiedad[descripcion]"><?= htmlspecialchars($campos['descripcion']); ?></textarea>
        </fieldset>
        <!-- Información Propiedad -->
        <fieldset>
            <legend>Información Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" min="1" max="9" value="<?= htmlspecialchars($campos['habitaciones']); ?>">
            <label for="wc">Baños</label>
            <input type="number" id="wc" name="propiedad[wc]" min="0" max="9" value="<?= htmlspecialchars($campos['wc']); ?>">
            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" min="0" max="9" value="<?= htmlspecialchars($campos['estacionamiento']); ?>">
        </fieldset>
        <!-- Vendedor -->
        <fieldset>
            <legend>Vendedor</legend>
            <select name="propiedad[vendedores_id]">
                <option value="">-- Seleccione --</option>
                <?php foreach ($vendedores as $v): ?>
                    <option value="<?= $v['id']; ?>" <?= $campos['vendedores_id']===$v['id']?'selected':''; ?>><?= ucwords("{$v['nombre']} {$v['apellido']}"); ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php incluir_template('footer'); ?>