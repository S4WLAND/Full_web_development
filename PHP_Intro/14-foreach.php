<?php include 'includes/header.php';

$clientes = ['pedro', 'juan', 'jose', 'maria'];

foreach ($clientes as $cliente) {
    echo $cliente . '<br>';
}

$cliente = [
    'nombre' => 'Juan',
    'saldo'=> 200,
    'tipo'=> 'premium',
];

foreach ($cliente as $key => $value) {
    echo $key . ' = ' . $value . '<br>';
}


$productos = [
    [
        'nombre'=> 'tablet',
        'precio'=> 200,
        'disponible'=> true,
    ],
    [
        'nombre'=> 'Televisión',
        'precio'=> 300,
        'disponible'=> true,
    ],
    [
        'nombre'=> 'Laptop',
        'precio'=> 400,
        'disponible'=> false,
    ]     
];


foreach ($productos as $producto ) { ?>
    <li>
        <p> Producto: <?php echo $producto['nombre']; ?> </p>
        <p> Precio: <?php echo $producto['precio']; ?> </p>
        <p><?php echo ($producto['disponible']) ? 'Disponible' : 'No disponible'; ?> </p ?>
    </li>
    <?php
}

include 'includes/footer.php';