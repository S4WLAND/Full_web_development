<?php


require 'includes/funciones.php';
incluir_template('header'); 
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <form class="formulario" method="POST" action="/login.php">
            <fieldset>
                <legend>Email y Contraseña</legend>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
            </fieldset>
        </form>

    </main>


<?php
    incluir_template('footer'); 
?>
