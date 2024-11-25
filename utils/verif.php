<?php 
 require_once ('../config/init.php');


if($_GET['id'] == 'subscribe') {

    if(isset( $_SESSION['inscriptionErreur']))
    {
        unset( $_SESSION['inscriptionErreur']);
    }
    $user = new User(
        $_POST['lastname'],
        $_POST['firstname'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['password'],
        $_POST['role'],
      
      
    );

    UserController::validateEmail($user->getEmail());
    UserController::validateFirstname($user->getFirstname());
    UserController::validateRole($user->getRole());
    UserController::validateName($user->getName());
    UserController::validatePhone($user->getPhone());
    UserController::validatePassword($user->getPassword());


    if(isset( $_SESSION['inscriptionErreur'])) {
        $_SESSION['firstname'] = $user->getFirstname();
        $_SESSION['lastname'] = $user->getName();
        $_SESSION['phone'] = $user->getPhone();
        $_SESSION['email'] = $user->getEmail();
     

        header('Location: /pages/subscribe.php');
        exit();

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