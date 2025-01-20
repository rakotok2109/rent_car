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
        header('Location: /');
    
    }

   
   
    header('Location: /');
}
else if($_GET['id'] == 'login') {
    $result = UserController::login($_POST['email'], $_POST['password']);
    if($result) {
    //   echo $_SESSION['user']->getName();
    $user= unserialize($_SESSION['user']);
    if($user->getRole() != 1)
    {
        header('Location: /pages/home.php');

    }
    else{
        header('Location: /pages/admin/dashboard_home.php');
    }
    }
    else {
        header('Location: /pages/auth/login.php');
    }
}
else if($_GET['id'] == 'logout') {
    unset($_SESSION['user']);
    header('Location: /pages/home.php');
}




else{
    header('Location: /pages/home.php');
}

