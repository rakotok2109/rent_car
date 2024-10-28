<?php 

// require_once(__DIR__ . /config/init.php)

class UserController {
    public static function subscribe (User $user)
    {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $pdo = PDOUtils::getSharedInstance();
        $pdo->execSQL('INSERT INTO users (email, password, role) VALUES (?, ?, ?)', [$user->getEmail(), $password, $user->getRole()]);
    }
}