<?php include 'includes/header.php';

$autenticado = true;
$admin = false;

if($autenticado && $admin ) {
    echo "Usuario autenticado correctamente";
} else {
    echo "Usuario no autenticado, inicia sesión";
}

// If anidados...
$cliente = [
    'nombre' => 'Stifh',
    'saldo' => 0,
    'informacion' => [
        'tipo' => 'Regular'
    ]
];

echo "<br>";

if( !empty($cliente) ) {
    echo "El Arreglo de cliente no esta vacio";

    if($cliente['saldo'] > 0) {
        echo "El Cliente tiene saldo disponible";
    } else {
        echo "No hay saldo";
    }
}

echo "<br>";

// else if
if($cliente['saldo'] > 0 ) {
    echo "El Cliente tiene saldo";
} else if ($cliente['informacion']['tipo'] === 'Premium') {
    echo "El Cliente es Premium";
} else {
    echo "No hay cliente definido o no tiene saldo o no es premium";
}

// Switch.

echo "<br>";

$tecnologia = 'HTML';

switch ($tecnologia) {
    case 'PHP':
        echo "PHP";
        echo '<br>';
        break;
    case 'JavaScript':
        echo "javascript";
        echo '<br>';
        break;
    case 'HTML':
        echo 'html';
        echo '<br>';
        break;
    default:
        echo "Algún lenguaje que no se cual es";
        echo '<br>';
        break;
}



include 'includes/footer.php';