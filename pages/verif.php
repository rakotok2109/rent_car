<?php 
 require_once ('../config/init.php');


if($_GET['id'] == 'subscribe') {


    $user = new User(
        $_POST['lastname'],
        $_POST['firstname'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['password'],
        $_POST['role'],
    );

    UserController::validateEmail($user->getEmail());

    if(isset( $_SESSION['inscriptionErreur'])) {
        header('Location: /subscribe.php');
    }

    else{
        UserController::subscribe($user);
        // header('Location: /');
    
    }
}

else if($_GET['id'] == 'subscribe') {
    $email = $_POST['email'];
    $password_deshashe = $_POST['password'];
}