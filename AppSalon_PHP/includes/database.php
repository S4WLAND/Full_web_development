<?php

$db = mysqli_connect(
    "localhost", 
    "root", 
    "root",
    "appsalon"
);

if (!$db) {
    echo "Hubo un error";
    exit;
}
