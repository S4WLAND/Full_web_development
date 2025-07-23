<?php

    // Comprobar la conexión
function conectarDB() {
    try {
        $db = mysqli_connect('localhost', 'root', 'root', 'bienes_raices_crud');
        return $db;
    } catch (mysqli_sql_exception $e) {
        error_log('Error de conexión DB: ' . $e->getMessage());
        
        echo '
        <div class="contenedor seccion">
            <div class="contenido-centrado">
                <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 2rem; border-radius: 5px; text-align: center; margin: 2rem 0;">
                    <h3 style="color: #856404; margin-bottom: 1rem;">⚠️ Error de Conexión</h3>
                    <p style="color: #856404; margin-bottom: 1.5rem;">
                        No se pudo conectar a la base de datos. Intenta nuevamente.
                    </p>
                    <a href="javascript:location.reload()" class="boton-amarillo">Reintentar</a>
                    <a href="/" class="boton-verde">Ir al Inicio</a>
                </div>
            </div>
        </div>
        ';
        exit();
    }
}
