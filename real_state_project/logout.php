<?php
require 'includes/funciones.php';

iniciarSesion();

$_SESSION = [];
session_destroy();

header('Location: /login.php');
exit;

