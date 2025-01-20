<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Configuration pour retourner des réponses JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // Identifier la méthode HTTP utilisée
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if (isset($_GET['id'])) {
                $car = CarController::getCarById($_GET['id']);
                if ($car) {
                    echo json_encode($car);
                } else {
                    echo json_encode(["error" => "Car not found"]);
                }
            } elseif (isset($_GET['user_id'])) {
                $cars = CarController::getCarByOwner($_GET['user_id']);
                echo json_encode($cars);
            } else {
                $cars = CarController::getAllCars();
                // echo json_encode($cars);
                return $cars;
                
            }
            break;

      case 'POST':
            if(isset($_GET['action'])){
                switch ($_GET['action']){
                    case 'add':
                        {
                            try{
                                var_dump($_FILES);
                            $user = unserialize($_SESSION['user']);
                            $idOwner = $user->getId();
                        
                            // Vérifiez si le fichier a été téléchargé
                            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                                // Définir le dossier de destination
                                $uploadDir =($_SERVER['DOCUMENT_ROOT'] .'/images/Vehicules/');
                                
                                // Récupérer le nom du fichier
                                $imageName = basename($_FILES['image']['name']);
                                
                                // Définir le chemin complet pour le fichier
                                $uploadFilePath = $uploadDir . $imageName;
                        
                                // Déplacer le fichier téléchargé vers le dossier de destination
                                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath)) {
                                    // Le fichier a été déplacé avec succès
                                    $car = new Car(
                                        $_POST['brand'],
                                        $_POST['model'],
                                        $_POST['kilometrage'],
                                        $_POST['description'],
                                        $_POST['vitesse'],
                                        $_POST['year'],
                                        $imageName, // Utiliser le nom de l'image
                                        $idOwner,
                                        $_POST['prix'],
                                        $_POST['ville'],
                                        $_POST['disponibilite'] = 1, // Par défaut, les voitures sont disponibles
                                        null
                                    );
                        
                                    // Gestion des erreurs
                                    if (isset($_SESSION['addCarError'])) {
                                        header('Location: /pages/admin/dashboard_add_car.php');
                                    } else {
                                        $result = CarController::addCar($car);
                                        $_SESSION['ajoutvoitureSuccess'] = true;
                                        header('Location: /pages/admin/dashboard_add_car.php');
                                    }
                                } else {
                                    // Gestion de l'erreur lors du déplacement du fichier
                                    $_SESSION['ajoutvoitureErreur'] = "Erreur lors de l'enregistrement de l'image.";
                                    header('Location: /pages/admin/dashboard_add_car.php');
                                }
                            } else {
                                // Gestion de l'erreur de téléchargement
                                $_SESSION['ajoutvoitureErreur'] = "Aucune image téléchargée ou erreur de téléchargement.";
                                header('Location: /pages/admin/dashboard_add_car.php');
                            }
                            }
                            catch(Exception $e){
                                // echo json_encode(["error" => $e->getMessage()]);
                                $_SESSION['ajoutvoitureErreur'] = `Erreur lors de l'enregistrement de la voiture.` . $e->getMessage() .  `.`;
                                header('Location: /pages/admin/dashboard_add_car.php');
                            }
                            
                            break;
                        }

                    case 'delete':
                        {

                            try{
                                // var_dump($_POST);
                                if (isset($_POST['id'])) {
                                    $car = CarController::getCarById($_POST['id']);
                                    if ($car) {
                                        $result = CarController::deleteCar($car->getId());
                                        $_SESSION['deleteMessage'] = "Véhicule supprimé.";
                                        header('Location: /pages/admin/dashboard_car.php');
                                    } else {
                                        $_SESSION['deleteMessage'] = "Véhicule non trouvé.";
                                        header('Location: /pages/admin/dashboard_car.php');
                                    }
                                } else {
                                    $_SESSION['deleteMessage'] = "ID obligatoire.";
                                    header('Location: /pages/admin/dashboard_car.php');
                                }
                            }
                            catch(Exception $e){
                                $_SESSION['deleteMessage'] = "Erreur lors de la suppression du véhicule." . $e->getMessage() . ".";
                                header('Location: /pages/admin/dashboard_car.php');
                            }
                            
                            break;
                
                     

                        }

                    case 'edit':
                        {

                            // if (isset($_GET['id'])) {
                            //     $car = CarController::getCarById($_GET['id']);
                            //     if ($car) {
                            //         $car->setBrand($putData['brand']);
                            //         $car->setModel($putData['model']);
                            //         $car->setKilometrage($putData['kilometrage']);
                            //         $car->setDescription($putData['description']);
                            //         $car->setVitesse($putData['vitesse']);
                            //         $car->setYear($putData['year']);
                            //         $car->setImage($putData['image']);
                            //         $car->setIdOwner($putData['user_id']);
                            //         $car->setPrix($putData['prix']);
                            //         $car->setVille($putData['ville']);
                            //         $car->setDisponibilite($putData['disponibilite']);
                            //         $result = CarController::updateCar($car);
                            //         echo json_encode(["success" => $result]);
                            //     } else {
                            //         echo json_encode(["error" => "Car not found"]);
                            //     }
                            // } else {
                            //     echo json_encode(["error" => "Car ID is required"]);
                            // }
                            break;

                        }

                    default:
                        echo json_encode(["error" => "Invalid action"]);
                        break;
                }
            }
 
    break;

          
           


            default:
            echo json_encode(["error" => "Invalid request method"]);
            break;


            
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
exit;
