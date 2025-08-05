<?php
require 'includes/config/database.php';
require 'includes/funciones.php';

iniciarSesion();

$db = conectarDB();
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email) {
        $errores[] = 'Email inválido';
    }
    if ($password === '') {
        $errores[] = 'La contraseña es obligatoria';
    }

    if (empty($errores)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($db, 'INSERT INTO usuarios (email, password) VALUES (?, ?)');
        mysqli_stmt_bind_param($stmt, 'ss', $email, $hash);
        if (mysqli_stmt_execute($stmt)) {
            echo 'Usuario creado correctamente';
        } else {
            $errores[] = 'Error al crear el usuario';
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($db);

?>

<form method="POST" action="/usuario.php" class="formulario">
    <fieldset>
        <legend>Nuevo Usuario</legend>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Registrar" class="boton boton-verde">
    </fieldset>
</form>

<?php foreach ($errores as $error): ?>
    <p class="alerta error"><?= htmlspecialchars($error); ?></p>
<?php endforeach; ?>

