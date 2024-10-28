<?php 

require_once('../config/init.php');
require_once("../config/init.php");

class UserController {
    public static function validateEmail ($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['inscriptionErreur'][] = 3;
        }
    }



    public static function subscribe (User $user)
    {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
    public static function login(User $user) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO users (email, password,nom, prenom, phone, role) VALUES (?, ?, ?, ?, ?, ?)', [$user->getEmail(), $password, $user->getName(),$user->getFirstname(),$user->getPhone() ,$user->getRole()]);
        $result = $pdo->requestSQL('SELECT * FROM users WHERE password = ?', [$password]);
        if ($result) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $email;
            header("Location: ../../pages/profil.php");
            exit();
        } else {
            echo "Combinaison email et mot de passe incorrect.";
        }
    }
}