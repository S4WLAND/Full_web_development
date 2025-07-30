<?php
// Definición de constantes para rutas de archivos y URLs
if (!defined('TEMPLATES_URL')) {
    define('TEMPLATES_URL', __DIR__ . '/templates');
}

if (!defined('FUNCIONES_URL')) {
    define('FUNCIONES_URL', __DIR__ . '/funciones.php');
}

// Configuración de imágenes: URL pública y ruta física
if (!defined('IMG_BASE_URL')) {
    define('IMG_BASE_URL', '/public/imagenes/');
}

if (!defined('IMG_BASE_PATH')) {
    define('IMG_BASE_PATH', __DIR__ . '/../public/imagenes/');
}