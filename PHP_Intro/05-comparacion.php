<?php include 'includes/header.php';

$num1 = 20;
$num2 = 30;
$num3 = 30;
$num4 = "30";

//Operadores de comparación
//mayor que
var_dump($num1 > $num2);
echo"<br/>";
// menor que
var_dump($num2 < $num2);
echo"<br/>";
//mayor o igual
var_dump($num1 >= $num2);
echo"<br/>";
//menor o igual
var_dump($num1 <= $num3);
echo"<br/>";
// igual sin considerar el tipo
var_dump($num2 == $num3);
echo"<br/>";
var_dump($num2 == $num4);
echo"<br/>";
// igual con considerar el tipo
var_dump($num2 === $num4);
echo"<br/>";
//diferente
var_dump($num1 != $num2);
echo"<br/>";
var_dump($num1 !== $num2);
echo"<br/>";
// comparador numerico
var_dump($num1 <=> $num2);
echo"<br/>"; // -1 si $num1 es menor que $num2, 0 si son iguales y 1 si $num1 es mayor que $num2





include 'includes/footer.php';