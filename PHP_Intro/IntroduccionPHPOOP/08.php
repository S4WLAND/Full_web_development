<?php include 'includes/header.php';

require 'vendor/autoload.php';

class Clientes {
    public function __construct() {
        echo "Clientes class initialized in 08.<br>";
    }
}

$detalles = new App\Detalles();
$clientes = new App\Clientes();

include 'includes/footer.php';