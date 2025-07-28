<?php

require '../../includes/config/database.php';
require '../../includes/funciones.php';

$db = conectarDB();

// Consultar y preparar vendedores
$vendedores = [];
$res = mysqli_query($db, "SELECT id, nombre, apellido FROM vendedores");
while ($fila = mysqli_fetch_assoc($res)) {
    $vendedores[] = $fila;
}

// Inicializar errores y valores
$errores = [];
$campos = [
    'titulo'         => '',
    'precio'         => '',
    'descripcion'    => '',
    'habitaciones'   => '',
    'wc'             => '',
    'estacionamiento'=> '',
    'vendedores_id'    => ''
];

// Reglas de validación
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
        'integer' => "El número de habitaciones debe ser un entero",
        'range'   => [[1,9], "El número de habitaciones debe estar entre 1 y 9"]
    ],
    'wc' => [
        'required'=> "El número de baños es obligatorio",
        'integer' => "El número de baños debe ser un entero",
        'range'   => [[0,9], "El número de baños debe estar entre 0 y 9"]
    ],
    'estacionamiento' => [
        'required'=> "El número de estacionamientos es obligatorio",
        'integer' => "El número de estacionamientos debe ser un entero",
        'range'   => [[0,9], "El número de estacionamientos debe estar entre 0 y 9"]
    ],
    'vendedores_id' => [
        'required'=> "Elige un vendedor",
        'in_array'=> [array_column($vendedores,'id'), "Vendedor inválido"]
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger y sanear con trim + escape
    $props = $_POST['propiedad'] ?? [];

    foreach ($rules as $campo => $ruleSet) {
        // Obtengo valor crudo y limpio
        $raw = $props[$campo] ?? '';
        $value = trim($raw);
        // Escapar para base de datos
        $value = mysqli_real_escape_string($db, $value);
        $campos[$campo] = $value;

        // Validaciones
        // 1. requerido
        if (isset($ruleSet['required']) && $value === '') {
            $errores[] = $ruleSet['required'];
            continue;
        }
        // 2. minlength
        if (isset($ruleSet['minlen']) && strlen($value) < $ruleSet['minlen'][0]) {
            $errores[] = $ruleSet['minlen'][1];
        }
        // 3. maxlength
        if (isset($ruleSet['maxlen']) && strlen($value) > $ruleSet['maxlen'][0]) {
            $errores[] = $ruleSet['maxlen'][1];
        }
        // 4. numeric
        if (isset($ruleSet['numeric']) && !is_numeric($value)) {
            $errores[] = $ruleSet['numeric'];
        }
        // 5. integer
        if (isset($ruleSet['integer']) && filter_var($value, FILTER_VALIDATE_INT) === false) {
            $errores[] = $ruleSet['integer'];
        }
        // 6. rango
        if (isset($ruleSet['range'])) {
            list($range, $msg) = $ruleSet['range'];
            if (!is_numeric($value) || $value < $range[0] || $value > $range[1]) {
                $errores[] = $msg;
            }
        }
        // 7. in_array (existencia en lista)
        if (isset($ruleSet['in_array'])) {
            list($haystack, $msg) = $ruleSet['in_array'];
            if (!in_array($value, $haystack, true)) {
                $errores[] = $msg;
            }
        }
    }

    if (empty($errores)) {
        $creado = date('Y/m/d');
        // Construir INSERT dinámico
        $cols  = array_keys($campos);
        $vals  = array_values($campos);
        $cols[] = 'creado';
        $vals[] = mysqli_real_escape_string($db, $creado);

        $colList = implode(", ", $cols);
        $valList = "'" . implode("', '", $vals) . "'";

        $sql = "INSERT INTO propiedades ($colList) VALUES ($valList)";

        if (mysqli_query($db, $sql)) {
            header('Location: /admin?resultado=1');
            exit;
        } else {
            $errores[] = 'Error al guardar en la base de datos.';
        }
    }
}

incluir_template('header');
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?php echo $campos['titulo']; ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo $campos['precio']; ?>">

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="propiedad[descripcion]"><?php echo $campos['descripcion']; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" min="1" max="9" value="<?php echo $campos['habitaciones']; ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="propiedad[wc]" min="0" max="9" value="<?php echo $campos['wc']; ?>">

            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" min="0" max="9" value="<?php echo $campos['estacionamiento']; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="propiedad[vendedores_id]">
                <option value="">-- Seleccione --</option>
                <?php foreach ($vendedores as $v): ?>
                    <option value="<?php echo $v['id']; ?>" <?php echo ($campos['vendedores_id'] === $v['id']) ? 'selected' : ''; ?>>
                        <?php echo ucwords("{$v['nombre']} {$v['apellido']}"); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluir_template('footer'); ?>
