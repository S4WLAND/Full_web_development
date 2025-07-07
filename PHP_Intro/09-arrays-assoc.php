<?php include 'includes/header.php';

$cliente = [
    'nombre' => 'Stifh',
    'apellido' => 'bl',
    'saldo' => 200,
    'info'=> [
        'telefono' => '123456789',
        'direccion' => 'Calle 123',
        'tipo'=> 'premium'
    ]
];
// reescribe la que existe
$cliente['info']['telefono'] = 'cambio de telefono';
// agrega la que no existe
$cliente['info']['descuento'] = '20%';

// eliminar
unset($cliente['info']['telefono']);

echo "<pre>";
var_dump($cliente);
var_dump($cliente["info"]);
echo "</pre>";


include 'includes/footer.php';