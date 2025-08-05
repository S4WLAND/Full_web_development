<?php
require 'includes/app.php';
require 'includes/config/database.php';
require 'includes/funciones.php';

iniciarSesion();

$db = conectarDB();
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $errores[] = 'Email inválido';
    }

    if (empty($errores)) {
        // Generar token y fecha de expiración
        $token = bin2hex(random_bytes(16));
        $token_exp = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Actualizar la base de datos con el token y la fecha de expiración
        $stmt = mysqli_prepare($db, 'UPDATE usuarios SET token = ?, token_exp = ? WHERE email = ?');
        mysqli_stmt_bind_param($stmt, 'sss', $token, $token_exp, $email);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Enviar correo electrónico con PHPMailer
            require 'vendor/autoload.php';
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail->Username = $_ENV['DB_USERNAME'];
$mail->Password = $_ENV['DB_PASSWORD'];

                //Recipients
                $mail->setFrom('no-reply@tudominio.com', 'Bienes Raices');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Restablecimiento de contraseña';
                $mail->Body    = 'Para restablecer tu contraseña, haz clic en el siguiente enlace: ' . "http://$_SERVER[HTTP_HOST]/update-password.php?token=$token";

                $mail->send();
                $mensajeExito = 'Se ha enviado un correo electrónico con las instrucciones para restablecer la contraseña.';
            } catch (Exception $e) {
                $errores[] = "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
            }
        } else {
            $errores[] = 'El correo electrónico no está registrado';
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($db);

incluir_template('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Restablecer Contraseña</h1>

    <?php if (isset($mensajeExito)): ?>
        <div class="alerta exito"><?= htmlspecialchars($mensajeExito); ?></div>
    <?php endif; ?>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error"><?= htmlspecialchars($error); ?></div>
    <?php endforeach; ?>

    <form method="POST" action="/reset-password.php" class="formulario">
        <fieldset>
            <legend>Introduce tu email</legend>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Enviar" class="boton boton-verde">
        </fieldset>
    </form>
</main>

<?php incluir_template('footer'); ?>

