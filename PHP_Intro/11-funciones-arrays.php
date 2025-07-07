<?php include 'includes/header.php';

// in_array - revisar si un arreglo contiene un elemento
echo "<br>";
var_dump(in_array('pedro', $clientes3));

// ordernar elementos de una arreglo
$numeros = array(1,3,5,6,8,1,3,4);
sort($numeros);
rsort($numeros);
print_r($numeros);

$cliente = array(
    'saldo' => 200,
    'tipo'=> 'premium',
    'nombre'=> 'stifh'
);

asort($cliente); // orden por valores

echo '<pre>';
var_dump($cliente);
echo '</pre>';

ksort($cliente); // orden por claves

echo '<pre>';
var_dump($cliente);
echo '</pre>';




include 'includes/footer.php';