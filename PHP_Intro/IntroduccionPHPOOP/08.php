<?php include 'includes/header.php';

// require 'clases/clientes.php';
// require 'clases/detalles.php';

// function autoload($className) {
//     $file = 'clases/' . strtolower($className) . '.php';
//     if (file_exists($file)) {
//         include $file;
//     }
// }

function autoloadWithNamespace($className) {
    // Obtener solo la última parte (nombre de clase sin namespace)
    $className = basename(str_replace('\\', '/', $className));
    $file = 'clases' . DIRECTORY_SEPARATOR . strtolower($className) . '.php';
    if (file_exists($file)) {
        include $file;
    }
}

spl_autoload_register('autoloadWithNamespace');

class Clientes {
    public function __construct() {
        echo "Clientes class initialized in 08.<br>";
    }
}

$detalles = new App\Detalles();
$clientes = new App\Clientes();

include 'includes/footer.php';