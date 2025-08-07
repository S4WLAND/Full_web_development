<?php include 'includes/header.php';

// conectar a la bd con mysqli

$query = "SELECT titulo, imagen FROM propiedades";

// preparando el query
$stmt = $db->prepare($query);

// ejecucion del query preparado
$stmt->execute();

// creación de la variable
$stmt->bind_result($titulo, $imagen);

// impresión del resultado
while($stmt->fetch()):
    var_dump($titulo);
endwhile;

include 'includes/footer.php';