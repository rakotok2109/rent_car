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
        header('Location: /pages/subscribe.php');
    }

    else{
        UserController::subscribe($user);
        // header('Location: /');
    
    }

   
   
    // header('Location: /');
}
// else if($_GET['id'] == 'login') {
//     $user = UserController::login($_POST['email'], $_POST['password']);
//     if($user) {
//         $_SESSION['user'] = $user;
//         header('Location: /');
//     }
//     else {
//         header('Location: /?error=1');
//     }
// }
// else if($_GET['id'] == 'logout') {
//     unset($_SESSION['user']);
//     header('Location: /');
// }
// else {
//     header('Location: /');
// }