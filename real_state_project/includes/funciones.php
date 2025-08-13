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


/**
 * include a specific template file
 * @param string $nombre name of the template file
 * @param bool $inicio if the template is for the homepage or not
 * @return void include all the url  
 */
function incluir_template(string $nombre, bool $inicio = false, array $props = []) {
    if (!empty($props)) {
        extract($props);
    }
    include TEMPLATES_URL . "/$nombre.php";
}

/**
 * Start or resume a session in a safe manner.
 *
 * This helper prevents repeated calls to session_start() which would
 * otherwise emit warnings if the session is already active.
 *
 * @return void
 */
function iniciarSesion(): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

/**
 * Determine if the current user is authenticated.
 *
 * @return bool True when the user has an active authenticated session
 */
function estaAutenticado(): bool {
    iniciarSesion();
    return (bool)($_SESSION['login'] ?? false);
}

/**
 * Protect a page from unauthorized access.
 *
 * If the user is not authenticated they will be redirected to the
 * login page and execution will stop.
 *
 * @return void
 */
function protegerRuta(): void {
    if (!estaAutenticado()) {
        header('Location: /login.php');
        exit;
    }
}