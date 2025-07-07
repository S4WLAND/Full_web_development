<?php include 'includes/header.php';

$name_client = 'Stifh bl  ';

// conocer la longitud de la cadena
echo strlen($name_client);
var_dump($name_client);

// eliminar espacios en blanco
echo strlen(trim($name_client));

// convertir a mayúsculas
echo strtoupper($name_client);

// convertir a minúsculas
echo strtolower($name_client);

// convertir a primera letra mayúscula
echo ucfirst($name_client);

// convertir a primera letra de cada palabra mayúscula
echo ucwords($name_client);

// reemplazar
echo str_replace('bl', 'Herless', $name_client);

// si string existe o no
echo strpos($name_client,'Stifh'); // imprime desde que posicion aparece si existe


// contar caracteres
$tipo_client = "Premium";
echo "El cliente " . trim($name_client) . " es " . $tipo_client;

echo "El cliente {$name_client} es {$tipo_client}";

include 'includes/footer.php';