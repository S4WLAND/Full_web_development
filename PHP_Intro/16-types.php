<?php include 'includes/header.php';

function user_authentication(bool $authenticated) :string|int{
    if($authenticated) {
        return 'El usuario esta autenticado';
    } else {
        return 20;
    }
}

$user = user_authentication(false);
echo $user;
include 'includes/footer.php';