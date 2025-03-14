<?php 

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/init.php');


class UserController {
    public static function subscribe (User $user)
    {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO users (email, password, nom, prenom, phone, role) VALUES (?, ?, ?, ?, ?, ?)', [$user->getEmail(), $password, $user->getName(),$user->getFirstname(),$user->getPhone() ,$user->getRole()]);
    }

    public static function addAdmin (User $user)
    {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO users (email, password, nom, prenom, phone, role, isAdmin) VALUES (?, ?, ?, ?, ?, ?, ?)', [$user->getEmail(), $password, $user->getName(),$user->getFirstname(),$user->getPhone() ,$user->getRole(), 1]);
    }

    public static function login($email, $password) {
        try{
            $pdo = PDOUtils::getSharedInstance();
            $result = $pdo->requestSQL('SELECT * FROM users WHERE email = ?', [$email]);
            if ($_POST['email']) {
                if (password_verify($password, $result[0]['password'])){
                  
                    $user = new User($result[0]['nom'], $result[0]['prenom'], $result[0]['phone'], $result[0]['email'], null, $result[0]['role'],$result[0]['isAdmin'], $result[0]['id']);
                  
                    $_SESSION['user'] = serialize($user);
                    $_SESSION['user_expiration'] = time() + 86400; // 86400 secondes = 1 jour
                    return true;
                   
                } else {
                    $_SESSION['loginErreur'][] = 0;
                    return false;
                }
            } else {
                $_SESSION['loginErreur'][] = 0;
                    return false;
            }
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
       
    }

    public static function getAllUsers()
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM users', []);
        $users = [];
        foreach ($result as $row) {
            $user = new User($row['nom'], $row['prenom'], $row['phone'], $row['email'], null, $row['role'], $row['isAdmin'], $row['id']);
            $users[] = $user;
        }
        return $users;
    }

    public static function getUserById($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM users WHERE id = ?', [$id]);
        if (count($result) > 0) {
            $row = $result[0];
            $user = new User($row['nom'], $row['prenom'], $row['phone'], $row['email'], null, $row['role'], $row['isAdmin'], $row['id']);
            return $user;
        }
        return null;
    }

    public static function deleteUser($id)
    {
        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('DELETE FROM users WHERE id = ?', [$id]);
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