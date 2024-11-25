<?php
require_once('../config/init.php');

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
            $car = new Car(
                null,
                $_POST['brand'],
                $_POST['model'],
                $_POST['kilometrage'],
                $_POST['description'],
                $_POST['vitesse'],
                $_POST['year'],
                $_POST['image'],
                $_POST['user_id']
            );
            $result = CarController::addCar($car);
            echo json_encode(["success" => $result]);
            break;

        case 'PUT':
            parse_str(file_get_contents("php://input"), $putData); // Récupérer les données PUT
            if (isset($_GET['id'])) {
                $car = CarController::getCarById($_GET['id']);
                if ($car) {
                    $car->setBrand($putData['brand']);
                    $car->setModel($putData['model']);
                    $car->setKilometrage($putData['kilometrage']);
                    $car->setDescription($putData['description']);
                    $car->setVitesse($putData['vitesse']);
                    $car->setYear($putData['year']);
                    $car->setImage($putData['image']);
                    $car->setIdOwner($putData['user_id']);
                    $result = CarController::updateCar($car);
                    echo json_encode(["success" => $result]);
                } else {
                    echo json_encode(["error" => "Car not found"]);
                }
            } else {
                echo json_encode(["error" => "Car ID is required"]);
            }
            break;

        case 'DELETE':
            if (isset($_GET['id'])) {
                $car = CarController::getCarById($_GET['id']);
                if ($car) {
                    $result = CarController::deleteCar($car);
                    echo json_encode(["success" => $result]);
                } else {
                    echo json_encode(["error" => "Car not found"]);
                }
            } else {
                echo json_encode(["error" => "Car ID is required"]);
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
