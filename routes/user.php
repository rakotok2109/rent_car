<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Configuration pour retourner des réponses JSON
header('Content-Type: application/json; charset=utf-8');

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (isset($_GET['id'])) {
                $user = UserController::getUserById($_GET['id']);
                if ($user) {
                    echo json_encode($user);
                } else {
                    echo json_encode(["error" => "User not found"]);
                }
            } else {
                $users = UserController::getAllUsers();
                echo json_encode($users);
            }
            break;
        case 'POST':
            if(isset($_GET['action'])){
                switch ($_GET['action']){
                    case 'add':
                        {
                            $user = new User(
                                $_POST['email'],
                                $_POST['password'],
                                $_POST['name'],
                                $_POST['firstname'],
                                $_POST['phone'],
                                $_POST['role']
                            );
                            UserController::subscribe($user);
                            echo json_encode(["message" => "User added"]);
                        }
                        break;
                    case 'login':
                        {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            if (UserController::login($email, $password)) {
                                echo json_encode(["message" => "User logged in"]);
                            } else {
                                http_response_code(401);
                                echo json_encode(["error" => "Invalid credentials"]);
                            }
                        }
                        break;
                    case 'addAdmin':
                        {
                            $user = new User(
                                $_POST['email'],
                                $_POST['password'],
                                $_POST['name'],
                                $_POST['firstname'],
                                $_POST['phone'],
                                $_POST['role']
                            );
                            UserController::addAdmin($user);
                            echo json_encode(["message" => "Admin added"]);
                        }
                        break;
                    case 'delete':
                    {
                        try{

                            if (isset($_POST['id'])) {
                                $user = UserController::getUserById($_POST['id']);
                                if ($user) {
                                    UserController::deleteUser($user->getId());

                                    $_SESSION['deleteMessage'] = json_encode(["message" => "Utilisateur supprimé avec succès", "success"=>true]);;
                                    header('Location: /pages/admin/dashboard_users.php');
                                } else {
                                    $_SESSION['deleteMessage'] = json_encode(["message" => "Erreur lors de la suppression de l'utilisateur.", "success"=>false]);;

                                    header('Location: /pages/admin/dashboard_users.php');
                                }
                            } else {
                                $_SESSION['deleteMessage'] = json_encode(["message" => "Veuillez sélectionner un utilisateur.", "success"=>false]);;

                                    header('Location: /pages/admin/dashboard_users.php');
                            }
                        } catch(Exception $e){
                            $_SESSION['deleteMessage'] = json_encode(["message" => "Erreur lors de la suppression du véhicule." . $e->getMessage() . ".", "succes"=>false]);;

                            header('Location: /pages/admin/dashboard_car.php');
                        }
                        
                        break;
                    }
                    case 'edit':
                        {
                            break;
                        }
                    default:
                    {
                        $_SESSION['deleteMessage'] = json_encode(["message" => "Action invalide", "success"=>false]);;

                        header('Location: /pages/admin/dashboard_users.php');
                    }
                    
                }
                break;
    }
}
}catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
exit;
