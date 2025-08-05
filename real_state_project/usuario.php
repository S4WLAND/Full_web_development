<?php
require 'includes/config/database.php';

$db = conectarDB();

$email  = $_POST['email'];
$password = $_POST['password'];
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$password')";
$result = mysqli_query($db, $query);

