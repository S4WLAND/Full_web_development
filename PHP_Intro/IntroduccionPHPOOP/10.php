<?php include 'includes/header.php';

// conectando a la db con PDO
$db = new PDO(
    'mysql:host=localhost; dbname=bienes_raices_crud;charset=utf8',
    'root', 
    'root');

$query = "SELECT titulo, imagen FROM propiedades";

$stmt = $db->prepare($query);

$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultado as $propiedad) {
    echo $propiedad['titulo'] . '<br>';
    echo $propiedad['imagen'] . '<br>';
}

include 'includes/footer.php';