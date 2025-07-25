<?php

require 'app.php';


/**
 * include a specific template file
 * @param string $nombre name of the template file
 * @param bool $inicio if the template is for the homepage or not
 * @return void include all the url  
 */
function incluir_template(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}