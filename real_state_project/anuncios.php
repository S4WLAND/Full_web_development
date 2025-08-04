 <?php


require 'includes/funciones.php';
incluir_template('header'); 

?>

    <main class="contenedor seccion">

        <h2>Casas y Depas en Venta</h2>
            <?php
                $limite = 3;
                include 'includes/templates/anuncios.php';
            ?>
    </main>

 
<?php
    incluir_template('footer'); 
?>
 