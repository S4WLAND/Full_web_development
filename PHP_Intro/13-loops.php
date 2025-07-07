<?php include 'includes/header.php';

// while 

$i = 100;

while($i <= 10){

    echo $i . '<br>';
    $i++;
}

do {
    echo $i .'<br>';
    $i++;
} while ($i <= 10);

// for loop

for ($i = 0; $i <= 10; $i++) {
    echo $i . '<br>';
}

// fizzbuzz
/*
 * 3 imprimir fizz
 * 5 imprimir buzz
 * 3 y 5 imprimir fizzbuzz 
 */

for ($i = 0; $i <= 100; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0) {
        echo 'fizzbuzz' . '<br>';
    } elseif ($i % 3 === 0) {
        echo 'fizz' . '<br>';
    } elseif ($i % 5 === 0) {
        echo 'buzz' . '<br>';
    } else {
        echo $i . '<br>';
    }
}




include 'includes/footer.php';