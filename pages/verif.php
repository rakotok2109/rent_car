<?php 
require_once ('../config/init.php');

if($_GET['id'] == 'login') {

    $user = login();
    
    UserController::login($user);

}


// else if($_GET['id'] == 'logout') {
//     unset($_SESSION['user']);
//     header('Location: /');
// }
// else {
//     header('Location: /');
// }