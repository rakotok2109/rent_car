<?php 

class User {
    private $id_;
    private $name_;
    private $fistname_;
    private $phone_;
    private $email_;
    private $password_;
    private $role_;

    public function __construct($name, $firstname, $phone, $email, $password, $role, $id = null) {

        $this->name_ = $name;
        $this->firstname_ = $firstname;
        $this->phone_ = $phone;
        $this->email_ = strtolower(trim($email));
        $this->password_ = $password;
        $this->role_ = $role;
    }

    public function getId() {
        return $this->id_;
    }

    public function setId($id) {
        $this->id_ = $id;
    }

    public function getName() {
        return $this->name_;
    }

    public function setName($name) {
        $this->name_ = $name;
    }

    public function getFirstname() {
        return $this->firstname_;
    }

    public function setFirstname($firstname) {
        $this->firstname_ = $firstname;
    }

    public function getPhone() {
        return $this->phone_;
    }

    public function setPhone($phone) {
        $this->phone_ = $phone;
    }


    public function getEmail() {
        return $this->email_;
    }

    public function setEmail($email) {
        $this->email_ = $email;
    }

    public function getPassword() {
        return $this->password_;
    }

    public function setPassword($password) {
        $this->password_ = $password;
    }

    public function getRole() {
        return $this->role_;
    }

    public function setRole($role) {
        $this->role_ = $role;
    }




    public static function findByEmail($email) {
        $pdo = PDOUtils::getSharedInstance();
        $result = $pdo->requestSQL('SELECT * FROM users WHERE email = ?', [$email]);
        if($result) {
            $user = new User($result['email'], $result['password'], $result['role']);
            $user->setId($result['id']);
           
            return $user;
        }
        return null;
    }
}