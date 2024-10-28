<?php 
 require_once (__DIR__ . 'config/init.php');
if($_GET['id'] == 'subscribe') {

    $user = new User($_POST['email'], $_POST['password'], $_POST['role']);

    UserController::subscribe($user);
   
   
    // header('Location: /');
} else {
    echo 'Error';
}