<?php 

require_once("../config/init.php");

class UserController {
    public static function subscribe (User $user)
    {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO users (email, password,nom, prenom, phone, role) VALUES (?, ?, ?, ?, ?, ?)', [$user->getEmail(), $password, $user->getName(),$user->getFirstname(),$user->getPhone() ,$user->getRole()]);
    }


    
    public static function emailExists($email)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM users WHERE email = ?', [$email]);
        return count($result) > 0;
    }



    public static function validateEmail ($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['inscriptionErreur'][] = 3;
        }
        //Vérifier si l'email existe déjà
        if (UserController::emailExists($email)) {
            $_SESSION['inscriptionErreur'][] = 2;
          

           
        }
    }

    public static function validateName($name)
    {
        if (strlen($name) < 3) {
            $_SESSION['inscriptionErreur'][] = 0; // Le nom doit faire plus de 2 caractères
        }
    }

    public static function validateFirstname($firstname)
    {
        if (strlen($firstname) < 3) {
            $_SESSION['inscriptionErreur'][] = 1; // Le prénom doit faire plus de 2 caractères
        }
    }

    public static function validateRole($role)
    {
        if (empty($role)) {
            $_SESSION['inscriptionErreur'][] = 4; // Le rôle doit être renseigné
        }
    }

    public static function validatePassword($password)
    {
        if (strlen($password) < 8 || 
            !preg_match('/[A-Z]/', $password) || 
            !preg_match('/[a-z]/', $password) || 
            !preg_match('/[0-9]/', $password) || 
            !preg_match('/[\W]/', $password)) {
            $_SESSION['inscriptionErreur'][] = 5; // Le mot de passe doit respecter les critères
        }
    }

    public static function validatePhone($phone)
    {
        if (!preg_match('/^\+?[0-9]{10,15}$/', $phone)) {
            $_SESSION['inscriptionErreur'][] = 10; // Veuillez entrer un numéro de téléphone valide
        }
    }




}