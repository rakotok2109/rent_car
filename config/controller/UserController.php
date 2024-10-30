<?php 

require_once('../config/init.php');

class UserController {
    public static function login($email, $password) {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM users WHERE email = ?', [$email]);
        if ($_POST['email']) {
            if (password_verify($password, $result['password'])){
                print('GOOD');
            } else {
                print("Mot de passe incotrect");
            }
        } else {
            print("L'email renseigné est incorrect");
        }
    }

    public static function validateEmail ($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['inscriptionErreur'][] = 3;
        }
        //Vérifier si l'email existe déjà
        //if (UserController::emailExists($email)) {
        //    $_SESSION['inscriptionErreur'][] = 2;
        //}
        

    }

    public static function emailExists($email)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->execSQL('SELECT * FROM users WHERE email = ?', [$email]);
        return count($result) > 0;
    }

    public static function subscribe (User $user)
    {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO users (email, password,nom, prenom, phone, role) VALUES (?, ?, ?, ?, ?, ?)', [$user->getEmail(), $password, $user->getName(),$user->getFirstname(),$user->getPhone() ,$user->getRole()]);
    }
}