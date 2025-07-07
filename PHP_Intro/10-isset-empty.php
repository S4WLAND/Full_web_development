<?php include 'includes/header.php';

$clientes = [];

$clientes2 = array();

$clientes3 = array('pedro', 'maria', 'jose');

$cliente = [
    'nombre' => 'Stifh',
    'saldo'=> 200
];

// empty

var_dump(empty($clientes));
var_dump(empty($clientes2));
var_dump(empty($clientes3));

// isset - revisar si un arreglo esta creado o una propiedad esta definida
echo "<br>";
var_dump(isset($clientes4));
var_dump(isset($cliente["nombre"]));





include 'includes/footer.php';