<?php
session_start();

// Cargar configuración global (constantes de rutas, URLs, etc.)
require __DIR__ . '/../../includes/app.php';

// Conexión a la base de datos y funciones de plantilla
require __DIR__ . '/../../includes/config/database.php';
require FUNCIONES_URL;

$db = conectarDB();

// Validar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin');
    exit;
}

// Validar CSRF token
$token = $_POST['csrf_token'] ?? '';
if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
    header('Location: /admin');
    exit;
}

// Validar ID de propiedad
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /admin');
    exit;
}

// Consultar propiedad antes de eliminar (para obtener imagen)
$sql = "SELECT imagen FROM propiedades WHERE id = ? LIMIT 1";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$propiedad = mysqli_fetch_assoc($result);

if (!$propiedad) {
    header('Location: /admin');
    exit;
}

// Eliminar registro de la base de datos
$sql = "DELETE FROM propiedades WHERE id = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    // Si la eliminación fue exitosa, eliminar imagen asociada
    if (!empty($propiedad['imagen']) && file_exists(IMG_BASE_PATH . '/' . $propiedad['imagen'])) {
        unlink(IMG_BASE_PATH . '/' . $propiedad['imagen']);
    }
    header('Location: /admin?resultado=3');
} else {
    header('Location: /admin');
}

mysqli_close($db);
exit;
?>