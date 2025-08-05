<?php
require 'includes/app.php';
require 'includes/config/database.php';
require 'includes/funciones.php';

iniciarSesion();

$db = conectarDB();
$errores = [];

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token es válido y no ha expirado
    $stmtSelect = mysqli_prepare($db, 'SELECT * FROM usuarios WHERE token = ? AND token_exp > NOW()');
    mysqli_stmt_bind_param($stmtSelect, 's', $token);
    mysqli_stmt_execute($stmtSelect);
    $result = mysqli_stmt_get_result($stmtSelect);

    if (mysqli_num_rows($result) === 1) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if ($password === '') {
                $errores[] = 'La contraseña es obligatoria';
            }
            if ($password !== $password_confirm) {
                $errores[] = 'Las contraseñas no coinciden';
            }

            if (empty($errores)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmtUpdate = mysqli_prepare($db, 'UPDATE usuarios SET password = ?, token = NULL, token_exp = NULL WHERE token = ?');
                mysqli_stmt_bind_param($stmtUpdate, 'ss', $hash, $token);
                if (mysqli_stmt_execute($stmtUpdate)) {
                    header('Location: /login.php?resultado=3');
                    exit;
                } else {
                    $errores[] = 'Error al actualizar la contraseña';
                }
                mysqli_stmt_close($stmtUpdate);
            }
        }
    } else {
        $errores[] = 'El token no es válido o ha expirado';
    }

    mysqli_stmt_close($stmtSelect);
} else {
    $errores[] = 'Token no proporcionado';
}

mysqli_close($db);

incluir_template('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Actualizar Contraseña</h1>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?= htmlspecialchars($error); ?></div>
    <?php endforeach; ?>

    <form method="POST" action="/update-password.php?token=<?= htmlspecialchars($token); ?>" class="formulario">
        <fieldset>
            <legend>Introduce tu nueva contraseña</legend>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <label for="password_confirm">Confirmar contraseña:</label>
            <input type="password" id="password_confirm" name="password_confirm" required>
            <input type="submit" value="Actualizar" class="boton boton-verde">
        </fieldset>
    </form>
</main>

<?php incluir_template('footer'); ?>