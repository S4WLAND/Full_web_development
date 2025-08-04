<?php

declare(strict_types=1);

// Validar que sea un ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /index.php');
    exit;
}

require 'includes/funciones.php';
require 'includes/config/database.php';

// Importar la conexión
$db = conectarDB();

// Consultar la propiedad
$query = "SELECT * FROM propiedades WHERE id = {$id}";
$resultado = mysqli_query($db, $query);

// Si no hay resultados, redirigir
if (!$resultado->num_rows) {
    header('Location: /index.php');
    exit;
}

$propiedad = mysqli_fetch_assoc($resultado);

incluir_template('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <picture>
        <?php if (!empty($propiedad['imagen'])) : ?>
            <img loading="lazy" src="/public/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad">
        <?php else : ?>
            <div class="imagen-placeholder">
                <span class="placeholder-icon">📷</span>
                <span class="placeholder-text">Sin imagen</span>
            </div>
        <?php endif; ?>
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo number_format((float)$propiedad['precio'], 2, ',', '.'); ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>

        <p><?php echo nl2br($propiedad['descripcion']); ?></p>

    </div>
</main>

<?php
mysqli_close($db);
incluir_template('footer');
?>