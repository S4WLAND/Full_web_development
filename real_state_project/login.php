<?php
require 'includes/app.php';
require 'includes/config/database.php';
require 'includes/funciones.php';

iniciarSesion();

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        $errores[] = 'Token CSRF inválido';
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email) {
        $errores[] = 'Email inválido';
    }

    if ($password === '') {
        $errores[] = 'La contraseña es obligatoria';
    }

    if (empty($errores)) {
        $db = conectarDB();
        $stmt = mysqli_prepare($db, 'SELECT id, password FROM usuarios WHERE email = ? LIMIT 1');
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['usuario_id'] = (int) $usuario['id'];
            header('Location: /admin');
            exit;
        }

        $errores[] = 'Credenciales no válidas';
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }
}

$_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));

incluir_template('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php if (isset($_GET['resultado']) && (int)$_GET['resultado'] === 3): ?>
        <div class="alerta exito">Contraseña actualizada correctamente.</div>
    <?php endif; ?>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?= htmlspecialchars($error); ?></div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/login.php">
        <fieldset>
            <legend>Email y Contraseña</legend>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <div style="text-align: right; margin-bottom: 1rem;">
                <a href="/reset-password.php">¿Olvidaste tu contraseña?</a>
            </div>

            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </fieldset>
    </form>
</main>

<?php incluir_template('footer'); ?>
