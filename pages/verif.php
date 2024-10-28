<?php 
 require_once (__DIR__ . 'config/init.php');
if($_GET['id'] == 'subscribe') {

    $user = new User($_POST['email'], $_POST['password'], $_POST['role']);

    UserController::subscribe($user);
   
   
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