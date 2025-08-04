<?php
// Importar la conexión
require_once __DIR__ . '/../config/database.php';

$db = conectarDB();

// consultar
$limite_seguro = filter_var($limite ?? 10, FILTER_VALIDATE_INT);
$query = "SELECT * FROM propiedades LIMIT $limite_seguro";

// resultado
$result = mysqli_query($db, $query);

?>

<!-- Contenedor de anuncios -->

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($result)) : ?>
    <div class="anuncio">
        <!-- Contenedor de imagen con altura fija -->
        <div class="imagen-container">
            <picture>
                <?php if (!empty($propiedad['imagen'])): ?>
                    <img loading="lazy" src="/public/imagenes/<?php echo $propiedad['imagen']; ?>" alt="<?php echo htmlspecialchars($propiedad['titulo']); ?>">
                <?php else: ?>
                    <div class="imagen-placeholder">
                        <span class="placeholder-icon">📷</span>
                        <span class="placeholder-text">Sin imagen</span>
                    </div>
                <?php endif; ?>
            </picture>
        </div>

        <div class="contenido-anuncio">
            <!-- Información básica que puede variar en tamaño -->
            <div class="info-basica">
                <h3><?php echo htmlspecialchars($propiedad['titulo']); ?></h3>
                <p class="descripcion"><?php echo htmlspecialchars($propiedad['descripcion']); ?></p>
                <p class="precio">$<?php echo number_format($propiedad['precio'], 0, ',', '.'); ?></p>
            </div>

            <!-- Características y botón que se mantienen alineados -->
            <div class="caracteristicas-y-boton">
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

                <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div>
        </div><!--.contenido-anuncio-->
    </div>
    <?php endwhile; ?>

</div> <!--.contenedor-anuncios-->

<?php
    mysqli_close($db);
?>