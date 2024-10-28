<?php 

require_once('../config/init.php');

class UserController {
    public static function login(User $user) {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM users WHERE password = ?', [$password]);
        if ($result) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $email;
            header("Location: ../../pages/profil.php");
            exit();
        } else {
            echo "Combinaison email et mot de passe incorrect.";
        }
    }
}