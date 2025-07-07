<?php include 'includes/header.php';

$carrito = array();
$carrito = ['tablet', 'audifonos', 'teclado'];
// <pre> para ver los detalles del array

echo $carrito[0] . "<br>"; 
echo $carrito[1] . "<br>";
echo $carrito[2];

// Agregar un elemento al indice del arreglo
$carrito[3] = "Monitor";

// agregar un elemento al final del arreglo
array_push($carrito, 'Mouse');

// agregar un elemento al inicio del arreglo
array_unshift($carrito, 'Cable USB');


echo "<pre>";
var_dump($carrito);
echo "</pre>";
include 'includes/footer.php';